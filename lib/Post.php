<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 18.08.2015
 * Time: 21:12
 */

class Post extends Entity {

    /*
     * @var string
     */
    private $authorId;

    /*
     * @var enum
     */
    private $status;

    /*
     * @var string
     */
    private $title;

    /*
     * @var string
     */
    private $content;

    /*
     * @var integer
     */
    private $channelId;

    public function __construct($id, $channelId, $authorId, $title, $content, $status) {
        parent::__construct($id);

        $this->channelId = $channelId;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->status = $status;
    }

    public function getChannelId() {
        return $this->channelId;
    }

    public function getAuthor() {
        return $this->authorId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setRead() {
        $this->status = Status::READ;
    }

    public function setPrior() {
        $this->status = Status::PRIOR;
    }

    public function delete() {
        $this->delete();
    }
}