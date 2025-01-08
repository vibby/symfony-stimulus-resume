<?php

namespace App\Repository;

use App\Entity\Contact;

class ContactRepository
{
    public function __construct(
        private readonly string $rootDirectory,
    )
    {
    }

    private string $filename = '/storage/contacts.csv';

    public function store(Contact $contact): void
    {
        $path = $this->rootDirectory . $this->filename;
        $fp = fopen($path, 'a');
        $newData = [
            str_replace("\t", ' ', $contact->name),
            str_replace("\t", ' ', $contact->email),
            str_replace("\t", ' ', $contact->subject),
            str_replace("\t", ' ', $contact->message),
        ];
        fputcsv($fp, $newData, "\t");
        fclose($fp);
    }
}