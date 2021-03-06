<?php

/**
 * Copyright (c) 2020. mc17
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

require_once __DIR__ . '/../src/php/CodeFactory.php';

use PHPUnit\Framework\TestCase;
use MailEncrypt\CodeFactory;

/**
 * Class CodeFactoryTest
 */
final class CodeFactoryTest extends TestCase
{

    public function testCorrectEncryptToAscii() : void
    {
        $factory = new CodeFactory();
        $this->assertEquals(
            '&#116;&#101;&#115;&#116;&#64;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;',
            $factory->encrypt_to_ascii("test@mail.com")
        );
    }

    public function testCorrectEncryptByCaesar() : void
    {
        $factory = new CodeFactory();
        $this->assertEquals(
            'vguvBockn0eqo',
            $factory->encrypt_by_caesar("test@mail.com")
        );
    }

    public function testCorrectMailToCode() : void {
        $factory = new CodeFactory();
        $this->assertEquals(
            "<a href='#' name='mail-encrypt-tag' value='vguvBockn0eqo'>vguvBockn0eqo</a>",
            $factory->mail_to_code('test@mail.com', '', true)
        );
        $this->assertEquals(
            "<a href='#' name='mail-encrypt-tag' value='vguvBockn0eqo'>vguv</a>",
            $factory->mail_to_code('test@mail.com', 'test', true)
        );
        $this->assertEquals(
            "<a href='&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#116;&#101;&#115;&#116;&#64;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;'>&#116;&#101;&#115;&#116;&#64;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;</a>",
            $factory->mail_to_code('test@mail.com', '', false)
        );
        $this->assertEquals(
            "<a href='&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#116;&#101;&#115;&#116;&#64;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;'>&#116;&#101;&#115;&#116;</a>",
            $factory->mail_to_code('test@mail.com', 'test', false)
        );
    }

}