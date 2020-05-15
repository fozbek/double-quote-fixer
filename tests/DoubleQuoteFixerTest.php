<?php

namespace Tests;

use Islambey\Fixers\DoubleQuoteFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

final class DoubleQuoteFixerTest extends AbstractFixerTestCase
{
    /**
     * @param string      $expected
     * @param null|string $input
     *
     * @dataProvider provideTestFixCases
     */
    public function testFix($expected, $input = null)
    {
        $this->doTest($expected, $input);
    }

    public function provideTestFixCases()
    {
        return [
            [
                '<?php $a = "";',
                '<?php $a = \'\';',
            ],
            [
                '<?php $a = "foo bar";',
                '<?php $a = \'foo bar\';',
            ],
            [
                '<?php $a = b"";',
                '<?php $a = b\'\';',
            ],
            [
                '<?php $a = B"";',
                '<?php $a = B\'\';',
            ],
            [
                '<?php $a = "foo bar";',
                '<?php $a = \'foo bar\';',
            ],
            [
                '<?php $a = b"foo bar";',
                '<?php $a = b\'foo bar\';',
            ],
            [
                '<?php $a = B"foo bar";',
                '<?php $a = B\'foo bar\';',
            ],
            [
                '<?php $a = "foo
                    bar";',
                '<?php $a = \'foo
                    bar\';',
            ],
            [
                '<?php $a = "foo"."bar"."$baz";',
                '<?php $a = \'foo\'.\'bar\'."$baz";',
            ],
            /*
            [
                '<?php $a = "foo \"bar\"";',
                '<?php $a = \'foo "bar"\';',
            ],
             */
            [<<<'EOF'
<?php $a = "\\foo\\bar\\\\";
EOF,
<<<'EOF'
<?php $a = '\\foo\\bar\\\\';
EOF,
            ],
            [
                '<?php $a = "foo \$bar7";',
                '<?php $a = \'foo $bar7\';',
            ],
            [
                '<?php $a = "foo \$(bar7)";',
                '<?php $a = \'foo $(bar7)\';',
            ],
            [
                '<?php $a = "foo \\\\(\$bar8)";',
                '<?php $a = \'foo \\\\($bar8)\';',
            ],
            ['<?php $a = "foo \\" \\$$bar";'],
            ['<?php $a = b"foo \\" \\$$bar";'],
            ['<?php $a = B"foo \\" \\$$bar";'],
            ['<?php $a = "foo \'bar\'";'],
            ['<?php $a = b"foo \'bar\'";'],
            ['<?php $a = B"foo \'bar\'";'],
            ['<?php $a = "foo $bar";'],
            ['<?php $a = b"foo $bar";'],
            ['<?php $a = B"foo $bar";'],
            ['<?php $a = "foo ${bar}";'],
            ['<?php $a = b"foo ${bar}";'],
            ['<?php $a = B"foo ${bar}";'],
            ['<?php $a = "foo\n bar";'],
            ['<?php $a = b"foo\n bar";'],
            ['<?php $a = B"foo\n bar";'],
            [<<<'EOF'
<?php $a = "\\\n";
EOF
            ],
        ];
    }

    /** @inheritDoc */
    protected function createFixer()
    {
        return new DoubleQuoteFixer();
    }
}