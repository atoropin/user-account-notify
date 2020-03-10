<?php

namespace Rir\UserAccountNotify;

class UserAccountMailMessage
{
    public $to;

    public $subject;

    public $bodyText;

    public $bodyHtml;

    public $attachments;

    /**
     * Set the content of the notification.
     *
     * @param  string  $to
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string  $subject
     * @return $this
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string  $bodyText
     * @return $this
     */
    public function bodyText($bodyText)
    {
        $this->bodyText = $bodyText;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string  $bodyHtml
     * @return $this
     */
    public function bodyHtml($bodyHtml)
    {
        $this->bodyHtml = $bodyHtml;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  array  $attachments
     * @return $this
     */
    public function attachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }
}
