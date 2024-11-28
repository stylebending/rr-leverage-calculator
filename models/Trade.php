<?php

class Trade
{
  public $symbol;
  public $direction;
  public $winLoss;
  public $openDate;
  public $closeDate;
  public $leverage;
  public $positionSize;
  public $entry;
  public $exit;
  public $fees;
  public $funding;
  public $closedPnl;
  public $roi;
  public $rr;

  function setSymbol($symbol)
  {
    $this->symbol = $symbol;
  }

  function getSymbol()
  {
    return $this->symbol;
  }

  function setDirection($direction)
  {
    $this->direction = $direction;
  }

  function getDirection()
  {
    return $this->direction;
  }

  function setWinLoss($winLoss)
  {
    $this->winLoss = $winLoss;
  }

  function getWinLoss()
  {
    return $this->winLoss;
  }

  function setOpenDate($openDate)
  {
    $this->openDate = $openDate;
  }

  function getOpenDate()
  {
    return $this->openDate;
  }

  function setCloseDate($closeDate)
  {
    $this->closeDate = $closeDate;
  }

  function getCloseDate()
  {
    return $this->closeDate;
  }

  function setLeverage($leverage)
  {
    $this->leverage = $leverage;
  }

  function getLeverage()
  {
    return $this->leverage;
  }

  function setPositionSize($positionSize)
  {
    $this->positionSize = $positionSize;
  }

  function getPositionSize()
  {
    return $this->positionSize;
  }

  function setEntry($entry)
  {
    $this->entry = $entry;
  }

  function getEntry()
  {
    return $this->entry;
  }

  function setExit($exit)
  {
    $this->exit = $exit;
  }

  function getExit()
  {
    return $this->exit;
  }

  function setFees($fees)
  {
    $this->fees = $fees;
  }

  function getFees()
  {
    return $this->fees;
  }

  function setFunding($funding)
  {
    $this->funding = $funding;
  }

  function getFunding()
  {
    return $this->funding;
  }

  function setClosedPnl($closedPnl)
  {
    $this->closedPnl = $closedPnl;
  }

  function getClosedPnl()
  {
    return $this->closedPnl;
  }

  function setRoi($roi)
  {
    $this->roi = $roi;
  }

  function getRoi()
  {
    return $this->roi;
  }

  function setRr($rr)
  {
    $this->rr = $rr;
  }

  function getRr()
  {
    return $this->rr;
  }
}
