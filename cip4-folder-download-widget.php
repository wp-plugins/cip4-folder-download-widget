<?php
/**
 * Plugin Name: CIP4 Folder Download Widget
 * Description: A widget that list all files in a defined folder for download.
 * Version: 1.0
 * Author: CIP4 - Stefan Meissner
 * Author URI: http://www.cip4.org
 */


add_action( 'widgets_init', 'cip4_folder_download_widget');


function cip4_folder_download_widget() {
	register_widget( 'CIP4FolderDownloadWidget' );
	
	wp_register_style( 'cip4-folder-download-widget-css', plugins_url('cip4-folder-download-widget/cip4-folder-download-widget.css') );
	wp_enqueue_style('cip4-folder-download-widget-css');
}



class CIP4FolderDownloadWidget extends WP_Widget {

	function CIP4FolderDownloadWidget() {
		$widget_ops = array( 'classname' => 'example', 'description' => __('A widget that list all files in a defined folder for download. ', 'example') );
		
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'cip4-folder-download-widget' );
		
		$this->WP_Widget( 'cip4-folder-download-widget', __('CIP4 Folder Download', 'example'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$folder = $instance['folder'];
		
		echo $before_widget;


		// show folder items
		if( $folder ) {
			
			$csvInfos = array();
			
			// read .cip4-download-info file
			$infoPath = $folder . '.cip4-download-info.csv';
			
			if(file_exists($infoPath)) {
				$infoFile = fopen($infoPath,"r");
				while (($line = fgetcsv($infoFile)) !== FALSE) {
					$csvInfos[$line[0]] = $line;
				}
				fclose($infoFile);
			}
			
			
			// read download folder
			$items = array();
			
			if ($handle = opendir($folder)) {
				
				while (false !== ($file = readdir($handle))) {
					
					if($file{0} != '.') { // starts NOT with .
					
						// if necessary, add file
						if ($csvInfos[$file] == '') {
							
							// add new info item
							$csvItem = array($file, 0);	
							$csvInfos[$file] = $csvItem;
						} 
					
						// get number downloads
						$downloads = $csvInfos[$file][1];
						
						// get file path
						$filepath = $folder . $file;
						
						$item = array();
						$item['filename'] = $file;
						$item['downloads'] = $downloads;
						$item['bytes'] = number_format(filesize($filepath) / 1024 / 1024, 1, ".", "") . ' MB';
						$item['created'] = date ("Y-m-d H:i:s", filectime($filepath));
						$item['link'] = plugins_url() . "/cip4-folder-download-widget/cip4-download.php?target=" . $filepath . "&info=" . $infoPath;
						$items[] = $item;
					}
				}
			}
			
			closedir($handle);
			
			// update .cip4-download-info file
			$fp = fopen($infoPath, 'w');

			foreach ($csvInfos as $row) {
			    fputcsv($fp, $row);
			}

			fclose($fp);
			
			// output
			$table = '';
			$table .= '<table class="cip4-folder-download-widget">';
			
			foreach($items as $item) {
				
				$table .= '<tr>';
				$table .= '<td class="cip4-fd-row-filename"><a href="' . $item['link'] .'">'. $item['filename'] . '</a></td>';
				$table .= '<td class="cip4-fd-row-downloads">' . $item['downloads'] . '</td>';
				$table .= '<td class="cip4-fd-row-size">' . $item['bytes'] . '</td>';
				$table .= '<td class="cip4-fd-row-created">' . $item['created'] . '</td>';
				$table .= '</tr>';
			}
			
			$table .= '</table>';
			
			echo $table;
		}
		
		echo $after_widget;
	}

	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['folder'] = strip_tags( $new_instance['folder'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('MyFolder', 'example'), 'folder' => __('wp-content/uploads/', 'example') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<!-- Show widgte ID -->
		<p>
			<label>
			Widget ID: 
			
			<?php

			if ($this -> number == '__i__') {
				echo '<b>[save widget first]</b>';
			} else {
				echo '<b>' . $this -> id . '</b>';
			}
			?>
			</label>
		</p>

		<!-- Widget Title: Text Input. -->
		<p>
			<label>
				Title:
				<input id="<?php echo $this -> get_field_id('title'); ?>" type="text" name="<?php echo $this -> get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
			</lable>
		</p>

		<!-- Folder Input -->
		<p>
			<label>
				Folder:
				<input id="<?php echo $this -> get_field_id('folder'); ?>" type="text" name="<?php echo $this -> get_field_name('folder'); ?>" value="<?php echo $instance['folder']; ?>" class="widefat" />
			</label>
		</p>

	<?php
	}
	}
?>