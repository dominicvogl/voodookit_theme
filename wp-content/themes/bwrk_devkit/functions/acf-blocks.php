<?php

//
// Return column classes
// ------------------------------------------------------

function get_column_classes($rownum) {

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


function get_flexible_fields($modules) {

	if( is_array($modules) ) {

		foreach($modules["flex-content-fields"] as $module) {

			switch ( $module["acf_fc_layout"] ) {

				case 'flex-module-news':

					$args = array(
						'posts_per_page' => $module["module_news_num"],
						'category__in' => $module["module_news_category"]
					);

					get_news($args);

					break;

				case 'flex-module-tourdates':

					$args = array(
						'posts_per_page' => $module["module_tourdates_num"],
					);

					get_tourdates($args);

					break;

				case 'flex-module-shop':
					?>

					<div id="shop" class="module module-shop-overview module-background">

						<div class="row">

							<div class="module-headline"><span>Shop</span></div>

							<?php

							foreach($module["module_shop_article"] as $article) {
								setup_postdata($article);
								$fields = get_fields($article->ID);
								?>

								<div class="column small-6 large-3 shop-item">
									<div class="image-wrap">
										<a href="<?php echo $fields["article_shop_uri"]; ?>">
											<span class="shop-item-overlay"><?php echo $article->post_title; ?></span>
											<?
											if(has_post_thumbnail($article->ID)) {
												echo get_the_post_thumbnail($article->ID, 'medium');
											}
											else {
												echo wp_get_attachment_image(1585, 'medium');
											}
											?>
										</a>
									</div>
									<div class="button-weiter">
										<a href="<?php echo $fields["article_shop_uri"]; ?>" title="<?php echo $article->post_title; ?>" target="_blank">Im Shop ansehen</a>
									</div>
								</div>

								<?php
							}
							?>

							<div class="column small-12">
								<div class="button-weiter">
									<a href="http://hamburgrecords.com/eisbrecher/" title="Alle Eisbrecher Artikel im Shop ansehen" target="_blank">Alle Artikel im Shop ansehen</a>
								</div>
							</div>

						</div>
					</div>

					<?php

					break;

				case 'flex-module-cinema':

					get_cinema($module);

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

function get_flexible_rows($rows) {

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

function get_cinema($module = NULL) {


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