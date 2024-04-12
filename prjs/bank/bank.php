<?php

declare(strict_types=1);

class BankAccount
{
    protected bool $isOpen = false;
    protected int $balance = 0;
    
    public function open()
    {
        if ($this->isOpen) {
            throw new Exception('account already open');
        }
        
        $this->isOpen = true;
    }

    public function close()
    {
        if (!$this->isOpen) {
            throw new Exception('account not open');
        }
        
        $this->isOpen = false;
        $this->balance = 0;
    }

    public function balance(): int
    {
        if (!$this->isOpen) {
            throw new Exception('account not open');
        }
        
        return $this->balance;
    }

    public function deposit(int $amt)
    {
        if (!$this->isOpen) {
            throw new Exception('account not open');
        }

        if ($amt <= 0) {
            throw new InvalidArgumentException('amount must be greater than 0');
        }
        
        $this->balance += $amt;
    }

    public function withdraw(int $amt)
    {
        if (!$this->isOpen) {
            throw new Exception('account not open');
        }

        if ($amt <= 0) {
            throw new InvalidArgumentException('amount must be greater than 0');
        }
        if ($amt > $this->balance) {
            throw new InvalidArgumentException('amount must be less than balance');
        }
        
        $this->balance -= $amt;
    }
}
