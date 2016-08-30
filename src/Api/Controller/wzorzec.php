<?php

interface Offer
{
    public function getPrice();
}

final class BaseOffer implements Offer
{
    public function getPrice()
    {
        return 40;
    }
}

final class SportDecorator implements Offer
{
    private $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getPrice()
    {
        return $this->offer->getPrice() + 20;
    }
}

final class EducationDecorator implements Offer
{
    private $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getPrice()
    {
        return $this->offer->getPrice() + 10;
    }
}

final class CinemaDecorator implements Offer
{
    private $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getPrice()
    {
        return $this->offer->getPrice() + 30;
    }
}

$offer = new BaseOffer();
$offerWithSport = new SportDecorator($offer);
$offerWithSportAndCinema = new CinemaDecorator(new SportDecorator($offer));
$fullOffer = new CinemaDecorator(new SportDecorator(new EducationDecorator($offer)));