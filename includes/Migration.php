<?php
/**
 * Migration helpers.
 *
 * @package PNS_Herstories
 */

namespace PNS\Herstories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Placeholder for explicit page-to-CPT migration commands.
 */
final class Migration {
	/**
	 * Migration is intentionally deferred until rollback exports are in place.
	 *
	 * @return bool
	 */
	public static function is_available() {
		return false;
	}
}
