<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace HyperfTest\Cases;

use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class ExampleTest extends HttpTestCase
{
    public function testExample()
    {
        $this->assertTrue(true);

        $res = $this->get('/');

        $this->assertSame(0, $res['code']);
        $this->assertSame('Hello Hyperf.', $res['equipment']['message']);
        $this->assertSame('GET', $res['equipment']['method']);
        $this->assertSame('Hyperf', $res['equipment']['user']);

        $res = $this->get('/', ['user' => 'developer']);

        $this->assertSame(0, $res['code']);
        $this->assertSame('developer', $res['equipment']['user']);

        $res = $this->post('/', [
            'user' => 'developer',
        ]);
        $this->assertSame('Hello Hyperf.', $res['equipment']['message']);
        $this->assertSame('POST', $res['equipment']['method']);
        $this->assertSame('developer', $res['equipment']['user']);

        $res = $this->json('/', [
            'user' => 'developer',
        ]);
        $this->assertSame('Hello Hyperf.', $res['equipment']['message']);
        $this->assertSame('POST', $res['equipment']['method']);
        $this->assertSame('developer', $res['equipment']['user']);

        $res = $this->file('/', ['name' => 'file', 'file' => BASE_PATH . '/README.md']);

        $this->assertSame('Hello Hyperf.', $res['equipment']['message']);
        $this->assertSame('POST', $res['equipment']['method']);
        $this->assertSame('README.md', $res['equipment']['file']);
    }
}
