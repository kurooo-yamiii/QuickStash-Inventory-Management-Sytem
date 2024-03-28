// Javascript for Laptop Inventory

function statusChoose(selectedStatus) {
    
    $.ajax({
      type: 'POST', 
      url: 'selection.php', 
      data: { status: selectedStatus },
      success: function(response) {
       
        $('#fetchResult').empty();
            $('#fetchResult').html(response);
      },
      error: function(error) {
      
        console.error('AJAX error:', error);
      }
    });
  }

  function statusAll(selectedStatus) {
    
    $.ajax({
      type: 'POST', 
      url: 'all.php', 
      data: { status: selectedStatus },
      success: function(response) {
       
        $('#fetchResult').empty();
            $('#fetchResult').html(response);
      },
      error: function(error) {
      
        console.error('AJAX error:', error);
      }
    });
  }

  function searchRecords(searchterm) {
    
    $.ajax({
      type: 'POST', 
      url: 'searchlaptop.php', 
      data: { search: searchterm },
      success: function(response) {
       
        $('#fetchResult').empty();
            $('#fetchResult').html(response);
            document.getElementById("search").value = "";
      },
      error: function(error) {
      
        console.error('AJAX error:', error);
      }
    });
  }

// Pop-up form exit and show

function showAddEquip() {
    document.getElementById("overlay").style.display = "flex";
}

function hidePopupForm() {
    document.getElementById("overlay").style.display = "none";
}

function hide2PopupForm() {
  document.getElementById("overlay2").style.display = "none";
  event.preventDefault();
}

function hide3PopupForm() {
  document.getElementById("overlay3").style.display = "none";
  event.preventDefault();
}

function hide4PopupForm() {
  event.preventDefault();
  document.getElementById("overlay4").style.display = "none";
 
}


function addItem() {
  var quantity = $('#quan').val().trim();
  var name = $('#name').val().trim();
  var brand = $('#brand').val().trim();
  var date = $('#date').val().trim();
  var status = $('#status').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'addlaptop.php', 
    data: { quantity: quantity, name: name, brand: brand, date: date, status: status },
    success: function(response) {
     
      $('#fetchResult').empty();
          $('#fetchResult').html(response);
          $('#status').val('Working');
          $('#quan').val('');
          $('#name').val('');
          $('#brand').val('');
          $('#date').val('');
          
          hidePopupForm();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function returnBorrow(rid) {
  $.ajax({
    type: 'POST', 
    url: 'returnlaptop.php', 
    data: {rid: rid},
    success: function(response) {
     
      $('#fetchResult').empty();
          $('#fetchResult').html(response);
        
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function deleteItem() {
  var delid = $('#delid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'laptopdel.php', 
    data: { delid: delid },
    success: function(response) {
     
      $('#fetchResult').empty();
          $('#fetchResult').html(response);
          hide4PopupForm();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function laptopDelete(delid) {
    
  $.ajax({
    type: 'POST', 
    url: 'constructdelete.php', 
    data: { delid: delid },
    success: function(response) {
     
      $('#deleteConstruct').empty();
          $('#deleteConstruct').html(response);
          document.getElementById("overlay4").style.display = "flex";
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function updateItem() {
  var quant = $('#quant').val().trim();
  var name = $('#name2').val().trim();
  var brand = $('#brand2').val().trim();
  var date = $('#date2').val().trim();
  var status = $('#status2').val().trim();
  var upid = $('#upid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'updatelaptop.php', 
    data: { quant: quant, name: name, brand: brand, date: date, status: status, upid: upid },
    success: function(response) {
     
      $('#fetchResult').empty();
          $('#fetchResult').html(response);
          hide2PopupForm();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function borrowItem() {
  var qt3 = $('#qt3').val().trim();
  var name = $('#name3').val().trim();
  var brand = $('#brand3').val().trim();
  var date = $('#date3').val().trim();
  var status = $('#status3').val().trim();
  var borrower = $('#borrower').val().trim();
  var bid = $('#bid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'borrowlaptop.php', 
    data: { qt3: qt3, name: name, brand: brand, date: date, status: status, bid: bid, borrower: borrower },
    success: function(response) {
     
      $('#fetchResult').empty();
          $('#fetchResult').html(response);
          hide3PopupForm();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

// Form cotructors fetching data and display it in the form

function constructUpdate(upid) {
    
  $.ajax({
    type: 'POST', 
    url: 'consupdate.php', 
    data: { upid: upid },
    success: function(response) {
     
      $('#updateConstruct').empty();
          $('#updateConstruct').html(response);
          document.getElementById("overlay2").style.display = "flex";
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function constructBorrow(bid){
  $.ajax({
    type: 'POST', 
    url: 'consborrow.php', 
    data: { bid: bid },
    success: function(response) {
     
      $('#borrowConstruct').empty();
          $('#borrowConstruct').html(response);
          document.getElementById("overlay3").style.display = "flex";
          document.getElementById("name3").readOnly = true;
          document.getElementById("status3").readOnly = true;
          document.getElementById("brand3").readOnly = true;
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

// Javascript for Tool Inventory

function searchTool(search) {
    
  $.ajax({
    type: 'POST', 
    url: 'toolsearch.php', 
    data: { search: search },
    success: function(response) {
     
      $('#fetchTools').empty();
          $('#fetchTools').html(response);
          document.getElementById("search2").value = "";
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function toolsAll(status) {
    
  $.ajax({
    type: 'POST', 
    url: 'toolall.php', 
    data: { status: status },
    success: function(response) {
     
      $('#fetchTools').empty();
          $('#fetchTools').html(response);
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function toolsChoose(selectedStatus) {
    
  $.ajax({
    type: 'POST', 
    url: 'toolchoose.php', 
    data: { status: selectedStatus },
    success: function(response) {
     
      $('#fetchTools').empty();
       $('#fetchTools').html(response);
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

/* Pop-up CSS Show and Hide */

function showtooladd() {
  document.getElementById("tooloverlay").style.display = "flex";
}

function hidetooladd() {
  document.getElementById("tooloverlay").style.display = "none";
}

function hidetooladd2() {
  event.preventDefault();
  document.getElementById("tooloverlay2").style.display = "none";
 
}

function hidetooladd3() {
  event.preventDefault();
  document.getElementById("tooloverlay3").style.display = "none";
}

function hidetooladd4() {
  event.preventDefault();
  document.getElementById("tooloverlay4").style.display = "none";
}

function hidetooladd5() {
  event.preventDefault();
  document.getElementById("tooloverlay5").style.display = "none";
}

function hidetooladd6() {
  event.preventDefault();
  document.getElementById("tooloverlay6").style.display = "none";
}

function accAddShow() {
  document.getElementById("accoverlay").style.display = "flex";
}

function accFormHide(){
  document.getElementById("accoverlay").style.display = "none";
}

function accForm2Hide(){
  event.preventDefault();
  document.getElementById("accoverlay2").style.display = "none";
 
}

document.getElementById("preventButton").addEventListener("click", function(event) {

  event.preventDefault();

  console.log("Button clicked!");

});

document.getElementById("preventButton2").addEventListener("click", function(event) {

  event.preventDefault();

  console.log("Button clicked!");

});

/* Tool Update and Borrow constructor */

function toolconsUpdate(upid) {
    
  $.ajax({
    type: 'POST', 
    url: 'toolconsupdate.php', 
    data: { upid: upid },
    success: function(response) {
     
      $('#toolConstruct').empty();
          $('#toolConstruct').html(response);
          document.getElementById("tooloverlay2").style.display = "flex";
        
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function toolconsBorrow(upid) {
    
  $.ajax({
    type: 'POST', 
    url: 'toolconsborrow.php', 
    data: { upid: upid },
    success: function(response) {
     
      $('#toolborrowConstruct').empty();
          $('#toolborrowConstruct').html(response);
          document.getElementById("tooloverlay3").style.display = "flex";
          document.getElementById("tstatus3").readOnly = true;
          document.getElementById("tname3").readOnly = true;
          document.getElementById("tbrand3").readOnly = true;
          document.getElementById("tdate3").readOnly = true;
       
         
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

/* Add, Delete, Update and Borrow for Tool Inventory */

function addTool() {
  var qty = $('#qty').val().trim();
  var name = $('#tname').val().trim();
  var brand = $('#tbrand').val().trim();
  var date = $('#tdate').val().trim();
  var status = $('#tstatus').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'tooladd.php', 
    data: { qty: qty, name: name, brand: brand, date: date, status: status },
    success: function(response) {
     
      $('#fetchTools').empty();
       $('#fetchTools').html(response);
          hidetooladd();
            document.getElementById("qty").value = "";
          document.getElementById("tname").value = "";
          document.getElementById("tbrand").value = "";
          document.getElementById("tdate").value = "";
          document.getElementById("tstatus").value = "";
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function deleteTool(delid) {
    
  $.ajax({
    type: 'POST', 
    url: 'toolconsdelete.php', 
    data: { delid: delid },
    success: function(response) {
     
      $('#tooldelConstruct').empty();
          $('#tooldelConstruct').html(response);
          document.getElementById("tooloverlay4").style.display = "flex";

    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function deleteToolItem() {
  var delid = $('#delid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'tooldelete.php', 
    data: { delid: delid },
    success: function(response) {
     
      $('#fetchTools').empty();
          $('#fetchTools').html(response);
          hidetooladd4();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}


function updateTool() {
  var qty = $('#qty2').val().trim();
  var name = $('#tname2').val().trim();
  var brand = $('#tbrand2').val().trim();
  var date = $('#tdate2').val().trim();
  var status = $('#tstatus2').val().trim();
  var tid = $('#tid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'toolupdate.php', 
    data: { tid: tid, qty: qty, name: name, brand: brand, date: date, status: status },
    success: function(response) {
     
      $('#fetchTools').empty();
       $('#fetchTools').html(response);
          hidetooladd2();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function borrowTool() {
  var qty = $('#qty3').val().trim();
  var name = $('#tname3').val().trim();
  var brand = $('#tbrand3').val().trim();
  var date = $('#tdate3').val().trim();
  var status = $('#tstatus3').val().trim();
  var borrower = $('#borrow').val().trim();
  var tbid = $('#tbid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'toolborrow.php', 
    data: { qty: qty, name: name, brand: brand, date: date, status: status, tbid: tbid, borrower: borrower },
    success: function(response) {
     
      $('#fetchTools').empty();
          $('#fetchTools').html(response);
          hidetooladd3();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function toolreturn(did) {
  $.ajax({
    type: 'POST', 
    url: 'toolreturn.php', 
    data: {did: did},
    success: function(response) {
     
      $('#fetchTools').empty();
      $('#fetchTools').html(response);
        
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

/* Borrow Tools qty Retriction */
document.addEventListener("DOMContentLoaded", function() {
  var qtyInput = document.getElementById("qty3");
  
  qtyInput.addEventListener("input", function(event) {
      var value = parseInt(qtyInput.value);
      var min = parseInt(qtyInput.min);
      var max = parseInt(qtyInput.max);
      
      if (value < min) {
          qtyInput.value = min;
      } else if (value > max) {
          qtyInput.value = max;
      } else {
        qtyInput.value = min;
      }
      
  });
});

/* Log History Functions */

function logChoose(selectedStatus) {
    
  $.ajax({
    type: 'POST', 
    url: 'logselection.php', 
    data: { status: selectedStatus },
    success: function(response) {
     
      $('#fetchLogHistory').empty();
       $('#fetchLogHistory').html(response);
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function logAll(selectedStatus) {
    
  $.ajax({
    type: 'POST', 
    url: 'logall.php', 
    data: { status: selectedStatus },
    success: function(response) {
     
      $('#fetchLogHistory').empty();
       $('#fetchLogHistory').html(response);
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function searchLog(searchterm) {
    
  $.ajax({
    type: 'POST', 
    url: 'logsearch.php', 
    data: { search: searchterm },
    success: function(response) {
     
      $('#fetchLogHistory').empty();
      $('#fetchLogHistory').html(response);
          document.getElementById("lsearch").value = "";
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function delConstruct(delid) {
    
  $.ajax({
    type: 'POST', 
    url: 'logconsdel.php', 
    data: { delid: delid },
    success: function(response) {
     
      $('#logdelConstruct').empty();
          $('#logdelConstruct').html(response);
          document.getElementById("tooloverlay5").style.display = "flex";
          document.getElementById("delall").value = "";
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function deleteLog() {
  var delid = $('#delid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'logdel.php', 
    data: { delid: delid },
    success: function(response) {
     
      $('#fetchLogHistory').empty();
          $('#fetchLogHistory').html(response);
          hidetooladd5();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

/* Printing Log Form using DOMPDF */
function printLogForm() {
 
  const pdf = new jsPDF();
  const formContent = document.getElementById("fetchLogHistory");

  const scaleValue = 0.154;
  const marginValues = [40, 0, 20, 12];

  pdf.html(formContent, {
      margin: marginValues,
      html2canvas: { scale: scaleValue },
      autoPaging: true
  }).then(() => {
      const totalPages = pdf.internal.pages.length;

      
      const headerImage = new Image();
      headerImage.src = 'resources/header.PNG'; 

     
      const footerImage = new Image();
      footerImage.src = 'resources/footer.PNG'; 

     pdf.setFontSize(12);
          pdf.text("INVENTORY LOG HISTORY", 80, 40); 

      for (let i = 1; i <= totalPages; i++) {
          
          pdf.setPage(i);
          pdf.addImage(headerImage, 'PNG', 12, 5, 184, 29); 

          pdf.addImage(footerImage, 'PNG', 12, pdf.internal.pageSize.height - 23, 180, 22); 

      }
      

      pdf.save("Quick Stash Log History.pdf"); 
  });
}

/* For Account Javascript */

function addAccount() {
  var fullname = $('#fullname').val().trim();
  var username = $('#username').val().trim();
  var password = $('#password').val().trim();

  $.ajax({
    type: 'POST', 
    url: 'accountadd.php', 
    data: { name: fullname, user: username, pass: password},
    success: function(response) {
     
      $('#fetchAccount').empty();
       $('#fetchAccount').html(response);
          accFormHide();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function constructAccount(upid) {
    
  $.ajax({
    type: 'POST', 
    url: 'accountconstruct.php', 
    data: { upid: upid },
    success: function(response) {
     
      $('#constructAccount').empty();
          $('#constructAccount').html(response);
          document.getElementById("accoverlay2").style.display = "flex";
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function editAccount() {
  var fullname = $('#fullname2').val().trim();
  var username = $('#username2').val().trim();
  var password = $('#password2').val().trim();
  var aid = $('#aid').val().trim();

  $.ajax({
    type: 'POST', 
    url: 'accountupdate.php', 
    data: { name: fullname, user: username, pass: password, aid: aid},
    success: function(response) {
     
      $('#fetchAccount').empty();
       $('#fetchAccount').html(response);
          accForm2Hide();
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function accconsDel(delid) {
    
  $.ajax({
    type: 'POST', 
    url: 'accconsdel.php', 
    data: { delid: delid },
    success: function(response) {
     
      $('#accdelConstruct').empty();
          $('#accdelConstruct').html(response);
          document.getElementById("tooloverlay6").style.display = "flex";

    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function deleteAccount() {
  var did = $('#delid').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'accountdelete.php', 
    data: { did: did},
    success: function(response) {
     
      $('#fetchAccount').empty();
       $('#fetchAccount').html(response);
       hidetooladd6();
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function searchAccount(search) {

  $.ajax({
    type: 'POST', 
    url: 'accountsearch.php', 
    data: { acc: search},
    success: function(response) {
     
      $('#fetchAccount').empty();
       $('#fetchAccount').html(response);
       document.getElementById("asearch").value = "";
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

/* Print Form Javascript  */

function printAll(All) {

  $.ajax({
    type: 'POST', 
    url: 'printall.php', 
    data: { All: All},
    success: function(response) {
     
      $('#fetchPrint').empty();
       $('#fetchPrint').html(response);
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function printType(type) {

  $.ajax({
    type: 'POST', 
    url: 'printtype.php', 
    data: { type: type},
    success: function(response) {
     
      $('#fetchPrint').empty();
       $('#fetchPrint').html(response);
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function printChoose(choose) {

  $.ajax({
    type: 'POST', 
    url: 'printchoose.php', 
    data: { choose: choose},
    success: function(response) {
     
      $('#fetchPrint').empty();
       $('#fetchPrint').html(response);
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function searchPrint(print) {

  $.ajax({
    type: 'POST', 
    url: 'printsearch.php', 
    data: { print: print},
    success: function(response) {
     
      $('#fetchPrint').empty();
       $('#fetchPrint').html(response);
       document.getElementById("searchprint").value = "";
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function printInventory() {
 
  const pdf = new jsPDF();
  const formContent = document.getElementById("fetchPrint");

  const scaleValue = 0.154;
  const marginValues = [40, 0, 20, 12];

  pdf.html(formContent, {
      margin: marginValues,
      html2canvas: { scale: scaleValue },
      autoPaging: true
  }).then(() => {
      const totalPages = pdf.internal.pages.length;

      
      const headerImage = new Image();
      headerImage.src = 'resources/header.PNG'; 

     
      const footerImage = new Image();
      footerImage.src = 'resources/footer.PNG'; 

     pdf.setFontSize(12);
          pdf.text("LABARATORY INVENTORY REPORT FORM", 63, 40); 

      for (let i = 1; i <= totalPages; i++) {
          
          pdf.setPage(i);
          pdf.addImage(headerImage, 'PNG', 12, 5, 184, 29); 

          pdf.addImage(footerImage, 'PNG', 12, pdf.internal.pageSize.height - 23, 180, 22); 

      }
      

      pdf.save("Quick Stash Inventory Form.pdf"); 
  });
}


/* Switching Forms */

var printForm = document.getElementById('printForm');
var manageAccount = document.getElementById('manageAccount');
var laptopInventory = document.getElementById('laptopInventory');
var toolInventory = document.getElementById('toolInventory');
var logHistory = document.getElementById('logHistory');
var dashBoard = document.getElementById('dashBoard');

var btnprint = document.getElementById('btnprint');
var btnaccount = document.getElementById('btnaccount');
var btnlaptop = document.getElementById('btnlaptop');
var btntools = document.getElementById('btntools');
var btnlog = document.getElementById('btnlog');
var btndashboard = document.getElementById('btndashboard');



function dashboardShow() 
{     
     dashBoard.style.display = 'block';
     btndashboard.style.background = 'rgb(224, 224, 232, 0.5)';
     logHistory.style.display = 'none';
     btnlog.style.background = 'none';
     toolInventory.style.display = 'none';
     btntools.style.background = 'none';
     laptopInventory.style.display = 'none';
     btnlaptop.style.background = 'none';
    
     printForm.style.display = 'none';
     btnprint.style.background = 'none';
     refreshDashboard();
 
}

function refreshDashboard()
{
  $.ajax({
    type: 'POST', 
    url: 'userrefdash.php', 
    data: {},
    success: function(response) {
     
      $('#fetchDashboard2').empty();
      $('#fetchDashboard2 script').remove();
       $('#fetchDashboard2').html(response)
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function laptopShow() 
{     
     dashBoard.style.display = 'none';
     btndashboard.style.background = 'none';
     logHistory.style.display = 'none';
     btnlog.style.background = 'none';
     toolInventory.style.display = 'none';
     btntools.style.background = 'none';
     laptopInventory.style.display = 'block';
     btnlaptop.style.background = 'rgb(224, 224, 232, 0.5)';
   
     printForm.style.display = 'none';
     btnprint.style.background = 'none';
     refereshLaptop();
    
}

function refereshLaptop()
{
  $.ajax({
    type: 'POST', 
    url: 'userefequip.php', 
    data: {},
    success: function(response) {
     
      $('#fetchResult').empty();
       $('#fetchResult').html(response)
       
    },
    error: function(error) {
    
      console.error('AJAX error:', error);
    }
  });
}

function toolsShow() 
{     
     dashBoard.style.display = 'none';
     btndashboard.style.background = 'none';
     logHistory.style.display = 'none';
     btnlog.style.background = 'none';
     toolInventory.style.display = 'block';
     btntools.style.background = 'rgb(224, 224, 232, 0.5)';
     laptopInventory.style.display = 'none';
     btnlaptop.style.background = 'none';
   
     printForm.style.display = 'none';
     btnprint.style.background = 'none';
     refereshTools();
}

function refereshTools()
{
  $.ajax({
    type: 'POST', 
    url: 'userreftools.php', 
    data: {},
    success: function(response) {
     
      $('#fetchTools').empty();
       $('#fetchTools').html(response)
       
    },
    error: function(error) {W
    
      console.error('AJAX error:', error);
    }
  });
}

function logShow() 
{     
     dashBoard.style.display = 'none';
     btndashboard.style.background = 'none';
     logHistory.style.display = 'block';
     btnlog.style.background = 'rgb(224, 224, 232, 0.5)';
     toolInventory.style.display = 'none';
     btntools.style.background = 'none';
     laptopInventory.style.display = 'none';
     btnlaptop.style.background = 'none';

     printForm.style.display = 'none';
     btnprint.style.background = 'none';
     refereshLog();
}

function refereshLog()
{
  $.ajax({
    type: 'POST', 
    url: 'userreflog.php', 
    data: {},
    success: function(response) {
     
      $('#fetchLogHistory').empty();
       $('#fetchLogHistory').html(response)
       
    },
    error: function(error) {W
    
      console.error('AJAX error:', error);
    }
  });
}


function printShow() 
{     
     dashBoard.style.display = 'none';
     btndashboard.style.background = 'none';
     logHistory.style.display = 'none';
     btnlog.style.background = 'none';
     toolInventory.style.display = 'none';
     btntools.style.background = 'none';
     laptopInventory.style.display = 'none';
     btnlaptop.style.background = 'none';
     printForm.style.display = 'block';
     btnprint.style.background = 'rgb(224, 224, 232, 0.5)';
     refereshPrint();
}

function refereshPrint()
{
  $.ajax({
    type: 'POST', 
    url: 'userefprint.php', 
    data: {},
    success: function(response) {
     
      $('#fetchPrint').empty();
       $('#fetchPrint').html(response)
       
    },
    error: function(error) {W
    
      console.error('AJAX error:', error);
    }
  });
}

