<div class="w-100 d-flex flex-wrap justify-content-between align-items-center gap-1">
    <div class="d-none d-lg-flex align-items-center gap-1 px-2 border rounded text-truncate" style="height: 38px;">
        <strong>Operator: </strong>
        <span>{{ auth()->user()->name }}</span>
    </div>
    
    <button class="d-lg-none btn btn-outline-dark d-flex align-items-center" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#operatorInfo"
            aria-expanded="false" 
            aria-controls="operatorInfo"
    >
        <x-utils.icon name="engineering" />    
    </button>

    <x-utils.search id="searchClient" placeholder="Client CPF..." />

    <div class="d-lg-none collapse w-100" id="operatorInfo">
        <div class="card card-body p-2 text-truncate d-flex">
            <strong>Operator: </strong>
            <span>{{ auth()->user()->name }}</span>
        </div>
    </div>
</div>