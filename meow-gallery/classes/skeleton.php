<?php

class Meow_MGL_Skeleton {

	public function __construct() {
		// Constructor logic if needed
	}

	public function get_skeleton_html($layout, $gallery_options, $image_count = null) {
		$skeleton_html = '<div class="mgl-gallery-skeleton" style="opacity: 1;">';
		
		switch ($layout) {
			case 'tiles':
				$skeleton_html .= $this->get_responsive_tiles_skeleton($gallery_options, $image_count);
				break;
			case 'masonry':
				$skeleton_html .= $this->get_responsive_masonry_skeleton($gallery_options, $image_count);
				break;
			case 'square':
				$skeleton_html .= $this->get_responsive_square_skeleton($gallery_options, $image_count);
				break;
			case 'justified':
				$skeleton_html .= $this->get_responsive_justified_skeleton($gallery_options, $image_count);
				break;
			case 'cascade':
				$skeleton_html .= $this->get_responsive_cascade_skeleton($gallery_options, $image_count);
				break;
			case 'horizontal':
			case 'carousel':
				$skeleton_html .= $this->get_responsive_horizontal_skeleton($gallery_options, $image_count);
				break;
			case 'map':
				$skeleton_html .= $this->get_map_skeleton($gallery_options, $image_count);
				break;
			default:
				$skeleton_html .= $this->get_responsive_tiles_skeleton($gallery_options, $image_count);
		}
		
		$skeleton_html .= '</div>';
		
		return $skeleton_html;
	}

	private function get_responsive_tiles_skeleton($gallery_options, $image_count = null) {
		$gutter = $gallery_options['tiles_gutter'] ?? 10;
		$columns = $gallery_options['tiles_columns'] ?? 2;
		$count = $image_count ?? 4; // Default to 4 if no count provided
		
		// Limit the skeleton to a reasonable number to prevent performance issues
		$count = min($count, 12);
		
		$html = '<div class="mgl-skeleton-tiles" style="width: 100%; opacity: 1;">';
		
		// Calculate rows needed
		$rows = ceil($count / $columns);
		$rows = min($rows, 3); // Limit to 3 rows maximum
		
		for ($row = 0; $row < $rows; $row++) {
			$html .= '<div style="display: flex; margin-bottom: ' . $gutter . 'px; height: 200px;">';
			
			// Items in this row
			$items_in_row = min($columns, $count - ($row * $columns));
			
			for ($col = 0; $col < $items_in_row; $col++) {
				$html .= '<div style="flex: 1; padding: 0 ' . ($gutter/2) . 'px;">';
				$html .= '<div class="mgl-skeleton-item" style="width: 100%; height: 100%; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
				$html .= '<div class="mgl-skeleton-shimmer"></div>';
				$html .= '</div></div>';
			}
			
			$html .= '</div>';
		}
		
		$html .= '</div>';

		return $html;
	}

	private function get_responsive_masonry_skeleton($gallery_options, $image_count = null) {
		$columns = $gallery_options['masonry_columns'] ?? 3;
		$gutter = $gallery_options['masonry_gutter'] ?? 5;
		$count = $image_count ?? 6; // Default to 6 if no count provided
		
		// Limit the skeleton to a reasonable number
		$count = min($count, $columns * 3); // Max 3 rows worth
		
		$html = '<div class="mgl-skeleton-masonry" style="display: grid; grid-template-columns: repeat(' . $columns . ', 1fr); gap: ' . $gutter . 'px; height: 300px; overflow: hidden;">';
		
		for ($i = 0; $i < $count; $i++) {
			$height = 120 + ($i % 3) * 40; // Vary heights slightly
			$html .= '<div class="mgl-skeleton-item" style="height: ' . $height . 'px; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div>';
		}
		
		$html .= '</div>';

		return $html;
	}

	private function get_responsive_square_skeleton($gallery_options, $image_count = null) {
		$columns = $gallery_options['square_columns_desktop'] ?? 5;
		$gutter = $gallery_options['square_gutter'] ?? 5;
		$count = $image_count ?? $columns; // Default to one row if no count provided
		
		// Limit the skeleton to a reasonable number
		$count = min($count, $columns * 2); // Max 2 rows worth
		
		$html = '<div class="mgl-skeleton-square" style="display: grid; grid-template-columns: repeat(' . $columns . ', 1fr); gap: ' . $gutter . 'px; overflow: hidden;">';
		
		for ($i = 0; $i < $count; $i++) {
			$html .= '<div class="mgl-skeleton-item" style="aspect-ratio: 1; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div>';
		}
		
		$html .= '</div>';

		return $html;
	}

	private function get_responsive_justified_skeleton($gallery_options, $image_count = null) {
		$gutter = $gallery_options['justified_gutter'] ?? 5;
		$row_height = min($gallery_options['justified_row_height'] ?? 200, 180); // Cap at 180px
		$count = $image_count ?? 6; // Default to 6 if no count provided
		
		// Limit the skeleton to a reasonable number
		$count = min($count, 9); // Max 9 items
		$items_per_row = 3;
		$rows = min(ceil($count / $items_per_row), 3); // Max 3 rows
		
		$html = '<div class="mgl-skeleton-justified">';
		
		for ($row = 0; $row < $rows; $row++) {
			$items_in_row = min($items_per_row, $count - ($row * $items_per_row));
			$html .= '<div style="display: flex; height: ' . $row_height . 'px; margin-bottom: ' . $gutter . 'px;">';
			
			for ($i = 0; $i < $items_in_row; $i++) {
				$html .= '<div class="mgl-skeleton-item" style="flex: 1; margin: 0 ' . ($gutter / 2) . 'px; height: 100%; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
				$html .= '<div class="mgl-skeleton-shimmer"></div>';
				$html .= '</div>';
			}
			
			$html .= '</div>';
		}
		
		$html .= '</div>';

		return $html;
	}

	private function get_responsive_cascade_skeleton($gallery_options, $image_count = null) {
		$gutter = $gallery_options['cascade_gutter'] ?? 10;
		$count = $image_count ?? 4; // Default to 4 if no count provided
		
		// Limit the skeleton to a reasonable number
		$count = min($count, 6); // Max 6 items for cascade
		
		$html = '<div class="mgl-skeleton-cascade" style="overflow: hidden;">';
		
		for ($i = 0; $i < $count; $i++) {
			$width = ($i % 2 === 0) ? '60%' : '40%';
			$height = 100 + ($i * 20);
			$margin_left = ($i % 2 === 0) ? '0' : 'auto';
			
			$html .= '<div style="padding: ' . ($gutter / 2) . 'px;">';
			$html .= '<div class="mgl-skeleton-item" style="height: ' . $height . 'px; width: ' . $width . '; margin-left: ' . $margin_left . '; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div></div>';
		}

		$html .= '</div>';

		return $html;
	}

	private function get_responsive_horizontal_skeleton($gallery_options, $image_count = null) {
		$image_height = min($gallery_options['horizontal_image_height'] ?? $gallery_options['carousel_image_height'] ?? 300, 250); // Cap at 250px
		$gutter = $gallery_options['horizontal_gutter'] ?? $gallery_options['carousel_gutter'] ?? 5;
		$count = $image_count ?? 5; // Default to 5 if no count provided
		
		// Limit the skeleton to a reasonable number
		$count = min($count, 8); // Max 8 items for horizontal
		
		$html = '<div class="mgl-skeleton-horizontal" style="height: ' . $image_height . 'px;">';
		$html .= '<div style="display: flex; height: 100%; overflow: hidden;">';
		
		for ($i = 0; $i < $count; $i++) {
			$width = $image_height * 0.8; // Fixed ratio
			$html .= '<div class="mgl-skeleton-item" style="height: 100%; width: ' . $width . 'px; flex-shrink: 0; margin-right: ' . $gutter . 'px; background-color: #e2e2e2; border-radius: 4px; overflow: hidden; position: relative;">';
			$html .= '<div class="mgl-skeleton-shimmer"></div>';
			$html .= '</div>';
		}
		
		$html .= '</div></div>';

		return $html;
	}

	private function get_map_skeleton($gallery_options, $image_count = null) {
		$height = $gallery_options['map_height'] ?? 400;
		
		$html = '<div class="mgl-skeleton-map" style="height: ' . $height . 'px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; position: relative; border-radius: 4px; overflow: hidden;">';
		$html .= '<div class="mgl-skeleton-shimmer"></div>';
		$html .= '</div>';
		
		return $html;
	}

}

?>