<?php

$INFO = array (
  'sql_host' => getenv('DB_HOST'),
  'sql_database' => 'wcp_workstation',
  'sql_user' => getenv('DB_USER'),
  'sql_pass' => getenv('DB_PASS'),
  'sql_port' => 3306,
  'sql_socket' => '',
  'sql_tbl_prefix' => '',
  'sql_utf8mb4' => true,
  'board_start' => 1553983148,
  'installed' => true,
  'base_url' => getenv('HOST') . '/_workstation/',
  'guest_group' => 2,
  'member_group' => 3,
  'admin_group' => 4,
);