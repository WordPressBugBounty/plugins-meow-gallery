<?php

class Meow_MGL_Skeleton {

	public function __construct() {
		// Constructor logic if needed
	}

	public function get_skeleton_html($layout, $gallery_options) {
		$skeleton_html = '<div class="mgl-gallery-skeleton" style="opacity: 1;">';
		
		switch ($layout) {
			case 'tiles':
				$skeleton_html .= $this->get_responsive_tiles_skeleton($gallery_options);
				break;
			case 'masonry':
				$skeleton_html .= $this->get_responsive_masonry_skeleton($gallery_options);
				break;
			case 'square':
				$skeleton_html .= $this->get_responsive_square_skeleton($gallery_options);
				break;
			case 'justified':
				$skeleton_html .= $this->get_responsive_justified_skeleton($gallery_options);
				break;
			case 'cascade':
				$skeleton_html .= $this->get_responsive_cascade_skeleton($gallery_options);
				break;
			case 'horizontal':
			case 'carousel':
				$skeleton_html .= $this->get_responsive_horizontal_skeleton($gallery_options);
				break;
			case 'map':
				$skeleton_html .= $this->get_map_skeleton($gallery_options);
				break;
			default:
				$skeleton_html .= $this->get_responsive_tiles_skeleton($gallery_options);
		}
		
		$skeleton_html .= '</div>';
		
		return $skeleton_html;
	}

	private function get_responsive_tiles_skeleton($gallery_options) {
		$gutter = $gallery_options['tiles_gutter'] ?? 10;
		
		// Very simple skeleton - minimal layout shift, conservative height
		$html = '<div class="mgl-skeleton-tiles" style="width: 100%; opacity: 1;">';
		
		// Just one simple row with fixed, conservative height
		$html .= '<div style="display: flex; margin-bottom: ' . $gutter . 'px; height: 200px;">';
		
		// Two simple boxes
		$html .= '<div style="flex: 1; padding: 0 ' . ($gutter/2) . 'px;">';
		$html .= '<div class="mgl-skeleton-item" style="width: 100%; height: 100%; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
		$html .= '<div class="mgl-skeleton-shimmer"></div>';
		$html .= '</div></div>';
		
		$html .= '<div style="flex: 1; padding: 0 ' . ($gutter/2) . 'px;">';
		$html .= '<div class="mgl-skeleton-item" style="width: 100%; height: 100%; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
		$html .= '<div class="mgl-skeleton-shimmer"></div>';
		$html .= '</div></div>';
		
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	private function get_responsive_masonry_skeleton($gallery_options) {
		$columns = $gallery_options['masonry_columns'] ?? 3;
		$gutter = $gallery_options['masonry_gutter'] ?? 5;
		
		// Simple masonry skeleton - just 3 items, fixed height
		$html = '<div class="mgl-skeleton-masonry" style="display: grid; grid-template-columns: repeat(' . $columns . ', 1fr); gap: ' . $gutter . 'px; height: 300px; overflow: hidden;">';
		
		for ($i = 0; $i < 3; $i++) {
			$height = 180 + ($i % 2) * 60; // Smaller, more conservative heights
			$html .= '<div class="mgl-skeleton-item" style="height: ' . $height . 'px; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div>';
		}
		
		$html .= '</div>';

		return $html;
	}

	private function get_responsive_square_skeleton($gallery_options) {
		$columns = $gallery_options['square_columns'] ?? 5;
		$gutter = $gallery_options['square_gutter'] ?? 5;
		
		// Simple square skeleton - just one row, conservative size
		$html = '<div class="mgl-skeleton-square" style="display: grid; grid-template-columns: repeat(' . $columns . ', 1fr); gap: ' . $gutter . 'px; height: 200px; overflow: hidden;">';
		
		for ($i = 0; $i < $columns; $i++) {
			$html .= '<div class="mgl-skeleton-item" style="aspect-ratio: 1; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div>';
		}
		
		$html .= '</div>';

		return $html;
	}

	private function get_responsive_justified_skeleton($gallery_options) {
		$gutter = $gallery_options['justified_gutter'] ?? 5;
		$row_height = min($gallery_options['justified_row_height'] ?? 200, 180); // Cap at 180px
		
		// Simple justified skeleton - just one row
		$html = '<div class="mgl-skeleton-justified" style="height: ' . $row_height . 'px;">';
		$html .= '<div style="display: flex; height: 100%;">';
		
		// 3 items in the row
		for ($i = 0; $i < 3; $i++) {
			$html .= '<div class="mgl-skeleton-item" style="flex: 1; margin: 0 ' . ($gutter / 2) . 'px; height: 100%; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div>';
		}
		
		$html .= '</div></div>';

		return $html;
	}

	private function get_responsive_cascade_skeleton($gallery_options) {
		$gutter = $gallery_options['cascade_gutter'] ?? 10;
		
		// Simple cascade skeleton - just 2 items, fixed small height
		$html = '<div class="mgl-skeleton-cascade" style="height: 250px; overflow: hidden;">';
		
		for ($i = 0; $i < 2; $i++) {
			$width = ($i % 2 === 0) ? '60%' : '40%';
			$height = 100 + ($i * 30);
			$margin_left = ($i % 2 === 0) ? '0' : 'auto';
			
			$html .= '<div style="padding: ' . ($gutter / 2) . 'px;">';
			$html .= '<div class="mgl-skeleton-item" style="height: ' . $height . 'px; width: ' . $width . '; margin-left: ' . $margin_left . '; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div></div>';
		}

		$html .= '</div>';

		return $html;
	}

	private function get_responsive_horizontal_skeleton($gallery_options) {
		$image_height = min($gallery_options['horizontal_image_height'] ?? $gallery_options['carousel_image_height'] ?? 300, 250); // Cap at 250px
		$gutter = $gallery_options['horizontal_gutter'] ?? $gallery_options['carousel_gutter'] ?? 5;
		
		// Simple horizontal skeleton - just 3 items, conservative height
		$html = '<div class="mgl-skeleton-horizontal" style="height: ' . $image_height . 'px;">';
		$html .= '<div style="display: flex; height: 100%; overflow: hidden;">';
		
		for ($i = 0; $i < 3; $i++) {
			$width = $image_height * 0.8; // Fixed ratio
			$html .= '<div class="mgl-skeleton-item" style="height: 100%; width: ' . $width . 'px; flex-shrink: 0; margin-right: ' . $gutter . 'px; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div>';
		}
		
		$html .= '</div></div>';

		return $html;
	}

	private function get_map_skeleton($gallery_options) {
		$height = $gallery_options['map_height'] ?? 400;
		
		$html = '<div class="mgl-skeleton-map" style="height: ' . $height . 'px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; position: relative; border-radius: 4px; overflow: hidden;">';
		$html .= '<div class="mgl-skeleton-shimmer"></div>';
		$html .= '</div>';
		
		return $html;
	}

}

?>