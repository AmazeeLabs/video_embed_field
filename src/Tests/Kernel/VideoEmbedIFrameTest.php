<?php

/**
 * @file
 * Contains Drupal\video_embed_field\Tests\Kernel\VideoEmbedIFrameTest.
 */

namespace Drupal\video_embed_field\Tests\Kernel;

use Drupal\video_embed_field\Tests\KernelTestBase;

/**
 * Test that the iframe element works.
 *
 * @group video_embed_field
 */
class VideoEmbedIFrameTest extends KernelTestBase {

  /**
   * @return array
   */
  public function videoEmbedIFrameTestCases() {
    return [
      'Default' => [
        [
          '#type' => 'video_embed_iframe',
        ],
        '<iframe></iframe>',
      ],
      'URL' => [
        [
          '#type' => 'video_embed_iframe',
          '#url' => 'https://www.youtube.com/embed/fdbFVWupSsw',
        ],
        '<iframe src="https://www.youtube.com/embed/fdbFVWupSsw"></iframe>',
      ],
      'URL, query' => [
        [
          '#type' => 'video_embed_iframe',
          '#url' => 'https://www.youtube.com/embed/fdbFVWupSsw',
          '#query' => ['autoplay' => '1'],
        ],
        '<iframe src="https://www.youtube.com/embed/fdbFVWupSsw?autoplay=1"></iframe>',
      ],
      'URL, query, attributes' => [
        [
          '#type' => 'video_embed_iframe',
          '#url' => 'https://www.youtube.com/embed/fdbFVWupSsw',
          '#query' => ['autoplay' => '1'],
          '#attributes' => [
            'width' => '100',
          ],
        ],
        '<iframe width="100" src="https://www.youtube.com/embed/fdbFVWupSsw?autoplay=1"></iframe>',
      ],
      'Query' => [
        [
          '#type' => 'video_embed_iframe',
          '#query' => ['autoplay' => '1'],
        ],
        '<iframe></iframe>',
      ],
      'Query, attributes' => [
        [
          '#type' => 'video_embed_iframe',
          '#query' => ['autoplay' => '1'],
          '#attributes' => [
            'width' => '100',
          ],
        ],
        '<iframe width="100"></iframe>',
      ],
      'Attributes' => [
        [
          '#type' => 'video_embed_iframe',
          '#attributes' => [
            'width' => '100',
          ],
        ],
        '<iframe width="100"></iframe>',
      ],
    ];
  }

  /**
   * Test the video embed iframe renders correctly.
   *
   * @dataProvider videoEmbedIFrameTestCases
   */
  public function testVideoEmbedIFrame($renderable, $markup) {
    $this->assertEquals($markup, trim($this->container->get('renderer')->renderRoot($renderable)));
  }

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

  }

}