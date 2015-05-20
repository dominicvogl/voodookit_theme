<?php

//
// Return column classes
// ------------------------------------------------------

function bwrk_get_column_classes($rownum) {

    switch($rownum) {
        case 2:
            return 'medium-6 columns';
            break;

        case 3:
            return 'medium-4 columns';
            break;

        default:
            return 'small-12 columns';
            break;
    }
}



//
// Get flexible Fields
// ------------------------------------------------------

function bwrk_get_flex_layouts($flexfield_array)
{
   if(is_array($flexfield_array))
   {
      foreach($flexfield_array as $flexfield) {
         switch($flexfield['acf_fc_layout']) {

            case $flexfield['acf_fc_layout']:

               echo 'Dieses Layout heißt: '.$flexfield['acf_fc_layout'];

               $path = TEMPLATEPATH.'/includes/partials/acf-'.$flexfield['acf_fc_layout'].'.php';
               varD(file_exists($path));

               load_acf_partial($path, $flexfield);

               break;

         }
      }
   }

   else
   {
      return false;
   }

}


function load_acf_partial($path, $flexfield)
{
   if(file_exists($path))
   {
      require($path);
   }
   else {
      $html = '<div class="alert alert-warning"><p>Partial konnte nicht geladen werden</p></div>';
      echo $html;
   }
}



function bwrk_get_flexible_fields($modules) {

	if( is_array($modules) ) {

		foreach($modules as $module) {

			switch ($module["acf_fc_layout"]) {

				// SIMPLE SLIDER
            case 'flexField_simpleSlider':

               if(is_array($module['slider_repeater'])) {

                  $html = '';
                  $html .= '<div class="module__simpleSlider slick-slider">';

                  foreach($module['slider_repeater'] as $slide) {

                     $html .= '<div class="slick-slide">';

                        $html .= '<h2>'.$slide['headline_text'].'</h2>';
                        $html .= '<div class="slide__image--wrap">';
                        $html .=  wp_get_attachment_image($slide['sliderimage_image'], 'medium');
                        $html .= '</div>';

                     $html .= '</div>';

                  }

                  $html .= '</div>';

                  echo $html;

               }

               else {
                  return false;
               }

					break;

			}

		}

	}

	else {
		return false;
	}

}



//
// Get Flexible Rows from nested Flexible Content Fields
// ----------------------------------------------------------------------------------------------

function bwrk_get_flexible_rows($rows) {

    foreach($rows as $row) {

        echo '<div class="'.get_column_classes( count($rows) ).'">';

        foreach($row as $flexelem) {

            switch($flexelem['acf_fc_layout']) {

                case 'flex-headline':
                    echo '<'.$flexelem['format'].'>'.$flexelem['content'].'</'.$flexelem['format'].'>';

                    break;

                case 'flex-textblock':
                    echo $flexelem['content'];

                    break;

                case 'flex-images':
                    // varD($flexelem);

                    if(!empty($flexelem['image-single'])) {
                        $size = 'medium';
                        echo '<div class="image-wrap">'.cccc_get_image($flexelem['image-single'], $size).'</div>';
                    }

                    if(!empty($flexelem['image-gallery'])) {
                        $size = 'thumbnail';

                        if($rownum == 1) {
                            $gridclasses = 'small-block-grid-2 medium-block-grid-4';
                        }
                        else {
                            $gridclasses = 'small-block-grid-2 medium-block-grid-3';
                        }

                        echo '<ul class="'.$gridclasses.'">';

                        foreach($flexelem['image-gallery'] as $image) {
                            echo '<li>'.cccc_get_image($image['ID']).'</li>';
                        }

                        echo '</ul>';
                    }

                    break;

                case 'flex-button':
                    echo '<a class="button '.$flexelem['buttonsize'].'" href="'.$flexelem['relation'].'">'.$flexelem['content'].'</a>';

                    break;

            }

        }

        echo '</div>';
    }
}



//
// Get Cinema Module Elements
// ----------------------------------------------------------------------------------------------

function bwrk_get_cinema($module = NULL) {


	$html = '<div id="cinema" class="module module-cinema module-background">';
	$html .= '<div class="module-headline"><span>Cinema</span></div>';

	foreach ($module["repeater_carousel_content"] as $row) {

		$html .= '<div class="row"><p class="sub-headline">'.$row["carousel_headline"].'</p></div>';

		$html .= '<div class="cinema-slider slick-multi-slider">';

		foreach($row["media_type"] as $mediatype) {

			if( $mediatype["acf_fc_layout"] == 'video' ) {

				$html .= '
					<div>
			            <div class="image-wrap image-'.$mediatype["video_thumbnail"].'">
			                <a href="'.$mediatype["video_url"].'" class="strip">
				                '.wp_get_attachment_image($mediatype["video_thumbnail"], 'small').'
				                <div class="overlay"></div>
			                </a>
			            </div>
			            <div class="content-wrap">
			                <h3>'.$mediatype["video_headline"].'</h3>
			                <hr/>
			                <a href="'.$mediatype["video_url"].'" class="strip">Video ansehen</a>
			                <span class="icon-'.$mediatype["video_plattform"].'"></span>
			            </div>
			        </div>
				';
			}
			else {

				foreach($mediatype["gallery_relations"] as $relation) {

					$imageID = 1395;
					$thumbID = get_post_thumbnail_id($relation);

					if( !empty($thumbID) ) {
						$imageID = $thumbID;
					}

					$html .= '
					<div>
			            <div class="image-wrap image-'.$imageID.'">
			                <a href="'.get_permalink($relation).'">
				                '.wp_get_attachment_image($imageID, 'small').'
				                <div class="overlay"></div>
			                </a>
			            </div>
			            <div class="content-wrap">
			                <h3>'.get_the_title($relation).'</h3>
			                <hr/>
			                <a href="'.get_permalink($relation).'">Bildergalerie ansehen</a>
			                <span class="icon-images"></span>
			            </div>
			        </div>
					';
				}


			}


		}

		$html .= '</div>';
	}



	$html .= '</div>';

	$html .= '<div class="arrow-button"><a href="#tourdaten" class="scroll-down"><span class="icon-arrow"></span></a></div>';

	$html .= '</div>';

	echo $html;

}