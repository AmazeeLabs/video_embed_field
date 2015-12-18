<?php

/**
 * @file
 * Contains \Drupal\video_embed_field\Plugin\video_embed_field\Provider\Vimeo.
 */

namespace Drupal\video_embed_field\Plugin\video_embed_field\Provider;

use Drupal\video_embed_field\ProviderPluginBase;

/**
 * @VideoEmbedProvider(
 *   id = "vimeo",
 *   title = @Translation("Vimeo")
 * )
 */
class Vimeo extends ProviderPluginBase {

  /**
   * {@inheritdoc}
   */
  public function renderEmbedCode($width, $height, $autoplay) {
    return [
      '#type' => 'html_tag',
      '#tag' => 'iframe',
      '#attributes' => [
        'width' => $width,
        'height' => $height,
        'frameborder' => '0',
        'allowfullscreen' => 'allowfullscreen',
        'src' => sprintf('https://player.vimeo.com/video/%s?autoplay=%d', $this->getVideoId(), $autoplay),
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getRemoteThumbnailUrl() {
    $video_data = json_decode(file_get_contents('http://vimeo.com/api/v2/video/' . $this->getVideoId() . '.json'));
    return $video_data[0]->thumbnail_large;
  }

  /**
   * {@inheritdoc}
   */
  public static function getIdFromInput($input) {
    preg_match('/^https?:\/\/(www\.)?vimeo.com\/(?<id>[0-9]*)$/', $input, $matches);
    return isset($matches['id']) ? $matches['id'] : FALSE;
  }

}
