<?php (defined('COT_CODE') && defined('COT_ADMIN')) or die('Wrong URL.');
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */

/**
 * Faker
 *
 * @package Faker
 * @author DigitalBalance
 * @copyright Copyright (c) 2014, DigitalBalance
 */

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('plug', 'faker');

cot_block($usr['isadmin']);

require_once cot_incfile('faker', 'plug');

$t = new XTemplate(cot_tplfile('faker', 'plug', true));

$type = cot_import('type', 'G', 'ALP');

// Pages
$t->assign(array(
    'FKR_PAGE_ACTION'    => cot_url('admin', 'm=other&p=faker&type=page&a=generate'),
    'FKR_PAGE_CAT'       => cot_selectbox_structure('page', '', 'fkr_page_cat'),
    'FKR_PAGE_AMOUNT'    => cot_selectbox('', 'fkr_page_amount', array('5', '10', '15', '25', '50'), '', false),
    'FKR_PAGE_MAX_TITLE' => cot_inputbox('number', 'fkr_page_max_title', 5),
    'FKR_PAGE_MAX_CHARS' => cot_inputbox('number', 'fkr_page_max_chars', 500)
));

if ($a == 'generate' && $type == 'page' && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $page_cat       = cot_import('fkr_page_cat', 'P', 'TXT');
    $page_amount    = cot_import('fkr_page_amount', 'P', 'INT');
    $page_max_title = cot_import('fkr_page_max_title', 'P', 'INT');
    $page_max_chars = cot_import('fkr_page_max_chars', 'P', 'INT');

    if (fkr_gen_page($page_cat, $page_amount, $page_max_title, $page_max_chars))
    {
        cot_message('fkr_done_page');
    }
    else
    {
        cot_error('fkr_error_page');
    }
    cot_redirect(cot_url('admin', 'm=other&p=faker', '', true));
}

// Users
$t->assign(array(
    'FKR_USER_ACTION' => cot_url('admin', 'm=other&p=faker&type=user&a=generate'),
    'FKR_USER_AMOUNT' => cot_selectbox('', 'fkr_user_amount', array('5', '10', '15', '25', '50'), '', false),
    'FKR_USER_GROUP'  => cot_selectbox_groups(4, 'fkr_user_group', array('5', $g))
));
$t->parse('MAIN.FORM');

if ($a == 'generate' && $type == 'user' && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $user_amount = cot_import('fkr_user_amount', 'P', 'INT');
    $user_group  = cot_import('fkr_user_group', 'P', 'INT');

    if (fkr_gen_user($user_amount, $user_group))
    {
        cot_message('fkr_done_user');
    }
    else
    {
        cot_error('fkr_error_user');
    }
    cot_redirect(cot_url('admin', 'm=other&p=faker', '', true));
}

cot_display_messages($t);

$t->parse();
$adminmain = $t->text();
