<?php

if ( ( $meta = wp_get_attachment_metadata( get_the_ID() ) ) ) 
	{
		$file = WP_CONTENT_DIR.'/uploads/'.$meta['file'];
		header( sprintf( 'Content-type: %s', $meta['sizes']['thumbnail']['mime-type'] ) );
		header( sprintf( 'Content-Length: %d', filesize( $file ) ) );
		require_once( $file );//WP_Filesystemの使用
		//readfile( $file );
	} 
else 
	{
		header( sprintf( 'Location: %s', esc_url( home_url() )  ) );
	}
