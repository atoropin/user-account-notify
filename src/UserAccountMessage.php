<?php

namespace Rir\UserAccountNotify;

class UserAccountMessage
{
    public $content;

    public $htmlContent;

    public $notificationTypeCode;

    public $organizationId;

    public $senderId;

    public $shortContent;

    public $title;

    public $userId;

    /**
     * Set the content of the notification.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string  $htmlContent
     * @return $this
     */
    public function htmlContent($htmlContent)
    {
        $this->htmlContent = $htmlContent;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string  $notificationTypeCode
     * @return $this
     */
    public function notificationTypeCode($notificationTypeCode)
    {
        $this->notificationTypeCode = $notificationTypeCode;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  int|null $organizationId
     * @return $this
     */
    public function organizationId($organizationId)
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  int|null  $senderId
     * @return $this
     */
    public function senderId($senderId)
    {
        $this->senderId = $senderId;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string  $shortContent
     * @return $this
     */
    public function shortContent($shortContent)
    {
        $this->shortContent = $shortContent;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string  $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  int|null  $userId
     * @return $this
     */
    public function userId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}