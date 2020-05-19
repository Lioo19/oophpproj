<?php

namespace Lioo19\Support;

use PHPUnit\Framework\TestCase;

/**
 * Testclass for Support class
 */
class SupportTest extends TestCase
{
    /**
     * Constructing Support and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateBasicSupport()
    {
        $support = new Support();
        $this->assertInstanceOf("\Lioo19\Support\Support", $support);
    }

    /**
     * Test checking that getLastRoll returns int
     *
     */
    public function testTextFilter()
    {
        $support = new Support();

        $res = $support->textFilter("hejsan", "markdown");
        $res = $support->textFilter("hejsan", "nl2br");
        $res = $support->textFilter("https://www.hej.hej", "link");
        $res = $support->textFilter("hejsan", "esc");
        $res = $support->textFilter("hejsan", "bbcode");

        $this->assertIsString($res);
    }

    /**
     * Test Support with argument 1
     * Meaning support only has one side, which means throw will result in 1
     */
    public function testSlugify()
    {
        $support = new Support();

        $res = $support->slugify("Här är jag!");
        $expected = "har-ar-jag";

        $this->assertEquals($res, $expected);
    }
}
