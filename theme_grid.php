<?php
/*
 * Youtube Gallery - Grid
 *
 */

$output .= '<div class="container">';
$output .= '<div class="row clearfix youtubegalleries">';
    foreach ( $ytgal_json['items'] as $ytgal_item ) {
        if(!empty( $ytgal_op_palylist_id )) {  // this code for playlist id
            $embedurl=$ytgal_item['contentDetails']['videoId'];
            $url='https://www.youtube.com/watch?v='.$ytgal_item['contentDetails']['videoId'].'';
            $i='<img src="http://img.youtube.com/vi/'.$ytgal_item['contentDetails']['videoId'].'/0.jpg">';
        }
        else{  // this code for channel id //
            $embedurl = $ytgal_item['id']['videoId'];
            $url='https://www.youtube.com/watch?v='.$ytgal_item['id']['videoId'].'';
            $i='<img src="http://img.youtube.com/vi/'.$ytgal_item['id']['videoId'].'/0.jpg">';
        }
        $yt_vid_title    = $ytgal_item['snippet']['title'];
        $yt_vid_title    = (strlen($yt_vid_title) > 35) ? substr($yt_vid_title,0, $title_limit ).' ...' : $yt_vid_title;
        
        $output .= '<div class="col-md-'.$cols.' col-sm-6 col-xs-12">';
            $output .='<div class="items">';
                $output .='<iframe width="100%" height="'.$video_height.'" src="https://www.youtube.com/embed/'.$embedurl.'" frameborder="0" allowfullscreen></iframe>';
                
                $output .='<p class="ytgal-name">';
                    $output .='<a href="'. $url .'" target"">'. $yt_vid_title .'</a>';
                $output .='</p>';

            $output .='</div>';
        $output .= '</div>'; // end col
    }
$output .= '</div>'; // end row
$output .= '</div>'; // end container

return $output;