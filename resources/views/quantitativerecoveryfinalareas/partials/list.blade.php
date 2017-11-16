<?php
$studentOld = '';
$studentNew = '';
?>
<?php $first = true; ?>
@foreach($pendings as $pending)
    <?php
    $studentOld = $studentNew;
    $studentNew = $pending->iduser;
    ?>
    @if(!$first && $studentOld != $studentNew )
        @include('quantitativerecoveryfinalareas.partials.pending', ['iduseractual' => $studentNew])
    @elseif($first)
        @include('quantitativerecoveryfinalareas.partials.pending', ['iduseractual' => $studentNew])
        <?php $first = false; ?>
    @endif
@endforeach