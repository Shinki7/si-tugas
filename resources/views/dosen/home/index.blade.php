@extends('dosen.layouts.app')

@section('content')
<div class="d-flex gap-4">
    <div class="card w-100 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Data User</div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h1 class="p"></h1>
            <i class="bi bi-person-circle" style="font-size: 50px"></i>
          </div>
        </div>
      </div>
      <div class="card w-100 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Data Report</div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="p"></h1>
                <i class="bi bi-bar-chart-fill" style="font-size: 50px"></i>
              </div>
        </div>
      </div>
      <div class="card w-100 text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Data Penyakit</div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="p"></h1>
                <i class="bi bi-clipboard2-pulse-fill" style="font-size: 50px"></i>
              </div>
        </div>
      </div>
</div>

@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush
