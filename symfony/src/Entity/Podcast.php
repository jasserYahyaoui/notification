<?php

namespace App\Entity;

class Podcast extends Content
{
    private ?string $podcastName = null;

    public function getPostcastName(): ?string
    {
        return $this->podcastName;
    }

    public function setPodcastName(?string $podcastName): self
    {
        $this->podcastName = $podcastName;

        return $this;
    }
}