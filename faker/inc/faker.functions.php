<?php (defined('COT_CODE') && defined('COT_ADMIN')) or die('Wrong URL.');

require_once cot_incfile('forms');
require_once cot_incfile('page', 'module');
require_once cot_incfile('users', 'module');
require_once cot_langfile('faker', 'plug');

require_once $cfg['plugins_dir'].'/faker/lib/autoload.php';

/**
 * Generate fake users
 * @param  int $user_amount Amount of users to generate
 * @param  int $user_group  User group for generated users
 * @return bool             True on success
 */
function fkr_gen_user($user_amount, $user_group)
{
    $faker = Faker\Factory::create();

    for ($i = 0; $i < $user_amount; $i++)
    {
        $user = array(
            'user_name'  => $faker->firstName,
            'user_text'  => $faker->sentence($nbWords = 5),
            'user_email' => $faker->email
            );
        $users[] = $user;
    }

    foreach ($users as $user)
    {
        if (!cot_add_user($user, '', '', '', $user_group, false))
        {
            $error = true;
        }
    }

    if ($error)
    {
        return false;
    }
    else
    {
        return true;
    }
}

/**
 * Generate pages with fake data
 * @param  string $page_cat       Category for pages
 * @param  int    $page_amount    Amount of pages to generate
 * @param  int    $page_max_title Max words in page title
 * @param  int    $page_max_chars Max characters in page text
 * @return bool                   True on success
 */
function fkr_gen_page($page_cat, $page_amount, $page_max_title, $page_max_chars)
{
    global $cfg;

    $faker = Faker\Factory::create();

    for ($i = 0; $i < $page_amount; $i++)
    {
        $page = array(
            'page_cat'    => $page_cat,
            'page_title'  => $faker->sentence($nbWords = $page_max_title),
            'page_desc'   => $faker->sentence($nbWords = 5),
            'page_text'   => $faker->text($maxNbChars = $page_max_chars),
            'page_parser' => $cfg['page']['parser'],
            'page_author' => '',
            'page_date'   => $faker->unixTime($max = 'now')
        );
        $pages[] = $page;
    }

    if (!cot_error_found())
    {
        cot::$db->insert(cot::$db->pages, $pages);

        return true;
    }
    else
    {
        return false;
    }
}
