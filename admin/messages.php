<div id="errorMsg" class="bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Login Error</div>
          <button type="button" class="btn-close" ></button>
        </div>
        <div class="toast-body" id="error_body"></div>
    </div>

    <div id="errorWarning" class="bs-toast toast toast-placement-ex m-3 fade bg-warning top-0 end-0 show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Account For Approval</div>
          <button type="button" class="btn-close" ></button>
        </div>
        <div class="toast-body" id="warning_body"></div>
    </div>

    <div id="warning" class="bs-toast toast toast-placement-ex m-3 fade bg-warning top-50 end-0 translate-middle-y show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Warning</div>
          <button type="button" class="btn-close" ></button>
        </div>
        <div class="toast-body" id="warning_msg"></div>
    </div>

    <div id="warning" class="bs-toast toast toast-placement-ex m-3 fade bg-warning top-50 end-0 translate-middle-y show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Warning</div>
          <button type="button" class="btn-close" ></button>
        </div>
        <div class="toast-body" id="warning_msg"></div>
    </div>

    <div id="warning2" class="bs-toast toast toast-placement-ex m-4 fade bg-warning top-0 end-0 show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Warning</div>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      <div class="toast-body" id="warning2_msg"></div>
    </div>

    <div id="successMsg" class="bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Login Success</div>
          <button type="button" class="btn-close" ></button>
        </div>
        <div class="toast-body" id="success_body"> </div>
        <div class="d-flex justi fy-content-end p-3">
        <span id="redirect_msg"> </span> &nbsp; <div id="spinner" class="spinner-border spinner-border-sm text-secondary" role="status">
            <span class="visually-hidden">Loading..</span>
        </div> 
        </div>
      
    </div>

    <div id="updateMsg" class="bs-toast toast toast-placement-ex m-3 fade bg-success top-50 end-0 show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Update Successful</div>
          <button type="button" class="btn-close" ></button>
        </div>
        <div class="toast-body" id="update_body"></div>
    </div>

    <div id="updateLogo" class="bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 show" style="display: none;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold" id="updateHead">Update Successful</div>
          <button type="button" class="btn-close" id="btnClose" ></button>
        </div>
        <div class="toast-body" id="update_body_logo"></div>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel" aria-hidden="true" style="visibility: hidden;">
        <div class="offcanvas-header">
        <h5 id="offcanvasBothLabel" class="offcanvas-title">PDAO Contact Information</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
        <p class="text-center">
        Hello, this employment site is managed by Mr. Nicasio R. Trinidad, the head of Pagsanjan's Persons with Disabilities Affairs Office. 
        If you want to be a member of the 3S staff or administration, please contact him using the details below.
        </p>
        <button type="button" class="btn btn-primary mb-2 d-grid w-100" onclick="copyToClipboard('#contact_number')"> <span id="contact_number"> +6394576747391 </span> </button>
        <button type="button" class="btn btn-outline-secondary d-grid w-100" onclick="copyToClipboard('#contact_email')"> <span id="contact_email"> nicasio_trinidad@gmail.com </span> </button>
        </div>
    </div>

    <script>
        function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        }
    </script>