<?php


class Meow_MGL_RML {


	public static function is_available() {
		return function_exists( 'wp_rml_get_by_absolute_path' ) && function_exists( 'wp_rml_get_attachments' );
	}


	/**
	 * Returns the whole Real Media Library folder structure as a flat, path-sorted
	 * list, so the admin can offer it as a selectable dropdown.
	 *
	 * @return array List of ['path' => string, 'name' => string, 'type' => int].
	 *               Type: 0 = Folder, 1 = Collection, 2 = Gallery.
	 */
	public static function get_all_folders() {
		if ( ! function_exists( 'wp_rml_objects' ) ) {
			return [];
		}

		$objects = wp_rml_objects();
		if ( ! is_array( $objects ) ) {
			return [];
		}

		$folders = [];
		foreach ( $objects as $folder ) {
			if ( ! self::is_folder( $folder ) ) {
				continue;
			}

			// Skip the root / "Unorganized" pseudo-folder (negative id, empty path).
			if ( (int) $folder->getId() < 0 ) {
				continue;
			}

			$path = $folder->getAbsolutePath();
			if ( $path === '' ) {
				continue;
			}

			$folders[] = [
				'path' => $path,
				'name' => $folder->getName(),
				'type' => (int) $folder->getType(),
			];
		}

		usort( $folders, function ( $a, $b ) {
			return strcmp( $a['path'], $b['path'] );
		} );

		return $folders;
	}


	public static function get_image_ids( $path ) {
		$folder = self::resolve_folder( $path );
		if ( is_wp_error( $folder ) ) {
			return $folder;
		}

		// Collect the folder's own media plus, if it is a Collection, the media of
		// all its sub-galleries (recursively) so they are returned as one gallery.
		$image_ids = self::collect_image_ids( $folder );
		if ( empty( $image_ids ) ) {
			return new WP_Error(
				'rml_folder_empty',
				sprintf( __( 'The Real Media Library folder "%s" is empty.', MGL_DOMAIN ), $folder->getAbsolutePath() )
			);
		}

		return array_values( array_unique( array_map( 'intval', $image_ids ) ) );
	}



	public static function get_collection_galleries( $path ) {
		$folder = self::resolve_folder( $path );
		if ( is_wp_error( $folder ) ) {
			return $folder;
		}

		// Only Folders and Collections can be turned into a collection.
		if ( self::is_gallery( $folder ) ) {
			return new WP_Error(
				'rml_not_a_collection',
				sprintf( __( 'The Real Media Library path "%s" is a gallery. Only folders and collections are allowed here.', MGL_DOMAIN ), $folder->getAbsolutePath() )
			);
		}

		$children = method_exists( $folder, 'getChildren' ) ? $folder->getChildren() : [];
		$children = is_array( $children ) ? $children : [];

		$galleries = [];
		foreach ( $children as $child ) {
			if ( ! self::is_folder( $child ) ) {
				continue;
			}

			// Gather all media of this sub-gallery (recursively) so we can pick a
			// lead image and skip empty ones.
			$media_ids = self::collect_image_ids( $child );
			if ( empty( $media_ids ) ) {
				continue;
			}
			$media_ids = array_values( array_unique( array_map( 'intval', $media_ids ) ) );

			$galleries[] = [
				'path' => $child->getAbsolutePath(),
				'name' => $child->getName(),
				'lead_image_id' => $media_ids[0],
			];
		}

		if ( empty( $galleries ) ) {
			return new WP_Error(
				'rml_collection_empty',
				sprintf( __( 'The Real Media Library folder "%s" has no galleries.', MGL_DOMAIN ), $folder->getAbsolutePath() )
			);
		}

		return $galleries;
	}


	private static function resolve_folder( $path ) {
		if ( ! self::is_available() ) {
			return new WP_Error( 'rml_not_enabled', __( 'Real Media Library is not enabled.', MGL_DOMAIN ) );
		}

		// RML uses "/" as the folder separator for absolute paths.
		$path = trim( str_replace( '\\', '/', (string) $path ) );
		$path = trim( $path, '/' );

		if ( $path === '' ) {
			return new WP_Error( 'rml_empty_path', __( 'The Real Media Library folder path is empty.', MGL_DOMAIN ) );
		}

		$folder = wp_rml_get_by_absolute_path( $path );
		if ( ! self::is_folder( $folder ) ) {
			return new WP_Error(
				'rml_folder_not_found',
				sprintf( __( 'The Real Media Library folder "%s" was not found.', MGL_DOMAIN ), $path )
			);
		}

		return $folder;
	}


	/**
	 * Whether the folder is a Gallery Data Folder (holds media directly).
	 * RML folder types: 0 = Folder, 1 = Collection, 2 = Gallery.
	 */
	private static function is_gallery( $folder ) {
		if ( ! is_object( $folder ) || ! method_exists( $folder, 'getType' ) ) {
			return false;
		}
		if ( defined( 'RML_TYPE_GALLERY' ) ) {
			return (int) $folder->getType() === RML_TYPE_GALLERY;
		}
		return (int) $folder->getType() === 2;
	}


	private static function collect_image_ids( $folder ) {
		$ids = wp_rml_get_attachments( $folder->getId() );
		$ids = is_array( $ids ) ? $ids : [];

		if ( method_exists( $folder, 'getChildren' ) ) {
			$children = $folder->getChildren();
			if ( is_array( $children ) ) {
				foreach ( $children as $child ) {
					if ( self::is_folder( $child ) ) {
						$ids = array_merge( $ids, self::collect_image_ids( $child ) );
					}
				}
			}
		}

		return $ids;
	}


	private static function is_folder( $folder ) {
		if ( function_exists( 'is_rml_folder' ) ) {
			return is_rml_folder( $folder );
		}
		return is_object( $folder ) && method_exists( $folder, 'getId' );
	}
}
