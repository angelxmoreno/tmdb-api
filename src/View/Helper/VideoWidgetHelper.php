<?php
declare(strict_types=1);

namespace App\View\Helper;

use App\Model\Entity\Video;
use Cake\Core\Exception\Exception;
use Cake\Routing\Router;
use Cake\View\Helper;

/**
 * VideoWidget helper
 *
 * @property-read Helper\HtmlHelper $Html
 */
class VideoWidgetHelper extends Helper
{
    protected $helpers = ['Html'];

    /**
     * @param Video $video
     * @return string
     */
    public function renderVideo(Video $video): string
    {
        switch (strtolower($video->site)) {

            case 'youtube':
                return $this->renderYouTubeWidget($video->site_uid);
                break;

            case 'vimeo':
                return $this->renderVimeoWidget($video->name, $video->site_uid);
                break;

            default:
                throw new Exception('Unknown video site: ' . $video->site);
        }
    }

    /**
     * @param string $video_id
     * @param array $params
     * @return string
     */
    protected function renderYouTubeWidget(string $video_id, array $params = []): string
    {
        $params = array_merge([
            'autoplay' => 0,
            'cc_lang_pref' => 'en',
            'hl' => 'en-us',
            'fs' => 1,
            'origin' => Router::url('/', true),
            'width' => 640,
            'height' => 360,
        ], $params);

        $width = $params['width'];
        $height = $params['height'];

        unset($params['width'], $params['height']);

        $id = 'ytplayer_' . $video_id;
        $type = 'text/html';
        $src = 'https://www.youtube.com/embed/' . $video_id . '?' . http_build_query($params);
        $frameborder = 0;

        return $this->Html->tag('iframe', '', compact('id', 'type', 'width', 'height', 'src', 'frameborder'));
    }

    /**
     * @param string $title
     * @param string $video_id
     * @param array $params
     * @return string
     */
    protected function renderVimeoWidget(string $title, string $video_id, array $params = []): string
    {
        $params = array_merge([
            'allowfullscreen' => 1,
            'width' => 640,
            'height' => 360,
        ], $params);

        $width = $params['width'];
        $height = $params['height'];

        unset($params['width'], $params['height']);

        $src = 'https://player.vimeo.com/video/' . $video_id;
        $frameborder = 0;

        return $this->Html->tag('iframe', '', compact('title', 'width', 'height', 'src', 'frameborder', 'allowfullscreen'));
    }
}
