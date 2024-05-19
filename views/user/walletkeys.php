<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/?c=user&v=account">Your account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Questions</li>
            </ol>
        </nav>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="heading">Wallet keys</h3>
    </div>
    <div class="col-12">
        <div class="alert alert-danger" role="alert">
            <b>IMPORTANT:</b> Your keys are very important. Do not show or share the <b>PRIVATE KEY</b>. You will lose all tokens
            if you share your private key. You can share <b>PUBLIC KEY</b> but only when it is required.
            We will <b>NEVER</b> ask you for your PRIVATE KEY ! That key is just for <b>YOU</b> ! You will need it when you want
            to transfer wallet details to other applications authorized by AcademiChain.
        </div>
    </div>
    <div class="col-12">
        <a class="btn btn-warning" id="btn-get-key">Get my keys</a>
    </div>

    <div id="keys-hidden-wrapper">
        <div class="col-12 pt-2">
            <div class="mb-3">
                <label for="puk" class="form-label">Public key</label>
                <textarea class="form-control" id="puk" rows="2"></textarea>
            </div>
        </div>
        <div class="col-12 pt-2">
            <div class="mb-3">
                <label for="prk" class="form-label">Private key</label>
                <textarea class="form-control" id="prk" rows="2"></textarea>
            </div>
        </div>
    </div>
</div>