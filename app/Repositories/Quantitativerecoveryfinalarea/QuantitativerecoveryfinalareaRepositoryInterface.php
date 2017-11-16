<?php

namespace SigeTurbo\Repositories\Quantitativerecoveryfinalarea;

interface QuantitativerecoveryfinalareaRepositoryInterface {
    public function all();
    public function find($iduantitativerecoveryfinalarea);
    public function store($data);
    public function update($uantitativerecoveryfinalarea,$data);
    public function destroy($quantitativerecoveryfinalarea);
    public function getRecoveryByUser($data);
    public function getHistoryByStudent($year, $users, $rating);
    public function recoveriesPendingsPreviousYears($year, $groups,$areas, $status, $users, $usersnotin);
}