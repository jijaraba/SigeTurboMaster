<?php

namespace SigeTurbo\Repositories\Qualitativerecoveryfinalarea;

interface QualitativerecoveryfinalareaRepositoryInterface {
    public function all();
    public function find($idqualitativerecoveryfinalarea);
    public function store($data);
    public function update($qualitativerecoveryfinalarea,$data);
    public function destroy($qualitativerecoveryfinalarea);
}