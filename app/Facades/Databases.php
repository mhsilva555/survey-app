<?php

namespace Survey\App\Facades;

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

class Databases
{
    /**
     * @param string $table
     * @param array $fields
     * @return null
     */
    public static function newTable(string $table, array $fields)
    {
        if (empty($fields)) {
            return null;
        }

        $list_fields = implode(', ', $fields);

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $tablename = $wpdb->prefix.$table;

        $sql = "CREATE TABLE $tablename ($list_fields) $charset_collate;";

        dbDelta($sql);
    }
}