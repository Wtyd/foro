<?php

class SupportMarkdownTest extends FeatureTestCase
{

    function test_the_post_content_suppport_markdown()
    {
        $importantText = 'Un texto muy importante';

        $post = $this->createPost([
            'content' => "La primera parte del texto. **$importantText**. La última parte del texto"
        ]);

        $this->visit($post->url)
            ->seeInElement('strong', $importantText);
    }

    function test_the_code_in_the_post_is_escaped()
    {
        $xssAttack = "<scrip>alert('Sharing code')</scrip>";

        $post = $this->createPost([
            'content' => "`$xssAttack`. Texto normal"
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText('Texto normal')
            ->seeText($xssAttack);
    }

    function test_xss_attack()
    {
        $xssAttack = "<scrip>alert('Malicious JS')</scrip>";

        $post = $this->createPost([
            'content' => "$xssAttack. Texto normal"
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText('Texto normal')
            ->seeText($xssAttack);
    }

    function test_xss_attack_with_html()
    {
        $xssAttack = "<img src='img.jpg'>";

        $post = $this->createPost([
            'content' => "$xssAttack. Texto normal"
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack);
    }
}
