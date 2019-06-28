<?php
/**
 * This file is part of comment_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  CommentManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

namespace CommentTests;

use CommentManagement\Application;
use PHPUnit\Framework\TestCase;

/**
 * Class CommentTestCase
 * @package CommentTests
 */
class CommentTestCase extends TestCase
{
    /**
     * Test that the index route returns http 200
     */
    public function testBaseRoute() {
        $app = new Application();
        $app->run();
        $this->assertEquals(200, http_response_code());
    }

}