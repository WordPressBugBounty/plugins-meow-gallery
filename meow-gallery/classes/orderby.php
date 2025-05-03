<?php

class Meow_MGL_OrderBy {

	public $admin = null;

	static function run( $images, $orderby = null, $order = 'asc' ) {
		$sqlOrderBy = '';
		$order = strtolower( $order );

		// Check params
		switch ( $orderby ) {
			case 'ids':
				$order === 'asc' ? sort( $images ) : rsort( $images );
				break;
		
			case 'random':
				shuffle( $images );
				return $images;
				break;
		
			case 'date':
				$sqlOrderBy = $order === 'asc'
					? ' ORDER BY p.post_date ASC'
					: ' ORDER BY p.post_date DESC';
				break;
		
			case 'modified':
				$sqlOrderBy = $order === 'asc'
					? ' ORDER BY p.post_modified ASC'
					: ' ORDER BY p.post_modified DESC';
				break;

			case 'filename':
			case 'title':
				$sqlOrderBy = $order === 'asc'
					? ' ORDER BY p.post_title ASC'
					: ' ORDER BY p.post_title DESC';
				break;
		
			case 'menu':
				$sqlOrderBy = $order === 'asc'
					? ' ORDER BY p.menu_order ASC'
					: ' ORDER BY p.menu_order DESC';
				break;
		
			case 'none':
				return $images;
		
			default:
				// no ordering
				break;
		}

		// Apply sort
		if ( !empty( $sqlOrderBy ) ) {
			global $wpdb;
			$wpIdsPlaceHolders = array_fill( 0, count( $images ), '%d' );
			$wpIdsPlaceHolders = implode( ', ', $wpIdsPlaceHolders );
			$query = $wpdb->prepare( "SELECT p.ID
				FROM $wpdb->posts p
				WHERE p.ID IN ($wpIdsPlaceHolders)" . $sqlOrderBy, $images );
			$images = $wpdb->get_col( $query );
			
		}
		return $images;
	}

}

?>
