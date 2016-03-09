<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>DASHBOARD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="<?php echo $baseURL; ?>assets/css/menu.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href='<?php echo $baseURL; ?>assets/css/style.css' type="text/css" media="screen">
         <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css">
          <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
          <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type = "text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
        <script src='<?php echo $baseURL; ?>/assets/js/jquery.bpopup-x.x.x.min.js'></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
<style type="text/css">
  
.monthlabel {
   float: left;
   margin-left: 4px;
   margin-right: 5px;
}
.b-close:hover {
background-color: #1e1e1e;
}
  select
  {
    width: 150px;
    font-family: Cursive;
   cursor: pointer;
   background-color: grey;
 }
 .end_month_label {
float: initial;
}
table a:link {
  color: #666;
  font-weight: bold;
  text-decoration:none;
}
table a:visited {
  color: #999999;
  font-weight:bold;
  text-decoration:none;
}
table a:active,
table a:hover {
  color: #bd5a35;
  text-decoration:underline;
}
table#table_view {
max-width: 78%;
font-family: Arial, Helvetica, sans-serif;
color: #666;
font-size: 13px;
text-shadow: 1px -1px 0px #fff;
background: #eaebec;
margin: 0px;
border: #ccc 5px solid;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
-moz-box-shadow: 0 1px 2px #d1d1d1;
-webkit-box-shadow: 0 1px 2px #d1d1d1;
box-shadow: 0 21px 50px;
color: #000000;
}

table th {
  padding: 7px 1px 13px 2px;
  border-top:1px solid #fafafa;
  border-bottom:1px solid #e0e0e0;

  background: #ededed;
  background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
  background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child{
  text-align: left;
  padding-left: 5px;
}

table tr{
  text-align: center;
  padding-left:20px;
}
table tr td:first-child{
  text-align: left;
  padding-left:5px;
  border-left: 0;
}
table tr td {
  padding: 2px;
  border-top: 1px solid #ffffff;
  border-bottom:1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;
  background: #fafafa;
  background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
  background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td{
  background: #f6f6f6;
  background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
  background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}

table tr:hover td{
  background: #f2f2f2;
  background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
  background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);  
}

</style>
<script type="text/javascript">
/*================================================= show loading while ajax call ================================================*/

$(document).ready(function(){
  $(document).ajaxStart(function(){
   document.getElementById('wait').style.display = '';
  });
  $(document).ajaxComplete(function(){
    document.getElementById('wait').style.display = 'none';
  });
 
}); 
/*==================================================== loading function end =====================================================*/
</script>
<script type="text/javascript">
/*================================================== CSV DOWNLOAD FUNCTION START ==================================================*/
$(document).ready(function () {

    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td,th)'),
            tmpColDelim = String.fromCharCode(11),
            tmpRowDelim = String.fromCharCode(0), 
            colDelim = '","',
            rowDelim = '"\r\n"',
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('th,td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();
                        var regexp = new RegExp(/["]/g);
                     text = text.replace(regexp, "“");
                    var regexp = new RegExp(/\<[^\<]+\>/g);
                     text = text.replace(regexp, "");
                    if (text == "") return '';
                       return '' + text + '';
                }).get().join(tmpColDelim);
            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }
    $("#export").on('click', function (event) {
    
        exportTableToCSV.apply(this, [$('#csvData>table'), 'order_Detail.csv']);

    });
});
/*=============================================== CSV Download Function END ====================================================*/
</script>

<script type="text/javascript">
/*================================================ STORE NAME ADD TO OPTION FINCTION START ===================================================*/
$(document).ready(function() 
        {
             $.ajax
                ({
                    url: "<?php echo $baseURL; ?>index.php/reportdetails/storeDetails",
                    data: {},
                    type: 'GET',
                   success :   function(data){
                     /*var table = $.parseJSON(data); */
                            $.each(data, function(k, v) 
                            {   
                            document.getElementById('storename').innerHTML +='<option value =' +v.store_id+'>'+v.store_name+'</option>'; 
                            document.getElementById('topSellingStore').innerHTML +='<option value =' +v.store_id+'>'+v.store_name+'</option>';
  
                            });
                        
                    }
              });
            
          });
/*================================================ STORE NAME ADD TO OPTION END ===================================================*/ 
</script>
<script type="text/javascript">
/*==================================  SALES REPORT HEADER FUNCTION CALL ============================================================*/
  function landingView()
  {
   
    
    document.getElementById('graph_view').style.display = 'none';
    document.getElementById('export').style.display = 'none';
    document.getElementById('table_view').style.display = 'none';
    document.getElementById('null_orders_view').style.display = 'none';
      document.getElementById('landing_graph_data').style.display = '';
    document.getElementById('landing_graph').style.display = '';
  
  }
  /*==================================  SALES REPORT HEADER FUNCTION CALL END ============================================================*/
</script>
<script type="text/javascript">
  /*======================================  CUSTOM PRODUCTS TABLE FUNCTION START =================================================*/
        function show_custom_table() 
        {
             document.getElementById('null_orders_view').innerHTML = '';
             document.getElementById('table_view').innerHTML = "";
            
             var x = document.getElementById("startDate");
             var start = x.value;
             var y = document.getElementById("endDate");
             var end = y.value;
             var s = document.getElementById("storename");
             var store = s.value;
             var c = document.getElementById("Catagory");
             var category = c.value;
                  
                  if (start==null || start=='' ) 
             {
                 alert("Please enter start Date");
                 return false;
             }
             else if (end==null || end=='' ) 
             {
                 alert("Please enter END Date");
                 return false;
             }
              else if (start >= end ) 
             {
                 alert("Please enter correct format");
                 return false;
             }
             else {
              $(document.getElementById('dlg')).bPopup().close();
            
               $.ajax
                      ({
                          url: "<?php echo $baseURL; ?>index.php/reportdetails/customReport",
                          data: {start:start,end:end,store:store,category:category},
                          type: 'GET',
                         success :   function(data){
                          
                          

                             document.getElementById('graph_view').style.display = 'none';
                              document.getElementById('landing_graph_data').style.display = 'none';
                             document.getElementById('landing_graph').style.display = 'none';
                             document.getElementById('null_orders_view').style.display = 'none';
                             document.getElementById('export').style.display = '';
                             
                             document.getElementById('table_view').style.display = '';
                              document.getElementById('table_view').innerHTML =' <tr><th>DATE OF ORDER</th> <th>PRODUCT IMAGE</th><th>PRODUCT NAME</th><th>STORE NAME</th><th>SELLING PRICE</th><th>SELLER EARNING</th><th>BNB COMMISSION</th> <th>SPECIAL DISCOUNT</th> <th>FINAL COMISSION</th><th>PAYMENT TYPE</th>  </tr>';
                   
                                  if(data == "{}"||data== null) 
                                  {
                                    console.log(data);
                                    document.getElementById('export').style.display = 'none';
                              document.getElementById('table_view').style.display = 'none';
                                    document.getElementById('null_orders_view').innerHTML += "<h2>NO ORDERS</h2>";
                               }

                             else{
                              
                              
                              /* var table = $.parseJSON(data); */
                              
                                      var sellingsum = 0;
                                       var sellerEarning = 0;
                                       var bnbComission = 0;
                                       var discount = 0;
                                       var fimalComission = 0;
                                            for(var len = data.length, i=0; i < len; i++){ 
                                                var item = data[i]; 
                                                sellingsum += parseInt(item.TotalSellingPrice, 10);
                                                sellerEarning+= parseInt(item.sellerEarning, 10);
                                                bnbComission+= parseInt(item.bnbCommissionValue, 10);
                                                discount+= parseInt(item.couponsRedeemed, 10);
                                                fimalComission+= parseInt(item.finalCommission, 10);
                                            }
                                            
                                   document.getElementById('table_view').innerHTML +='<tr style="font-weight: bolder;"><td ><strong><b>TOTAL</b></strong></td><td>No. Of Orders '+i+'</td><td></td><td></td><strong><td>INR.' +sellingsum +'</td></strong><strong><td>INR.' +sellerEarning +'</td></strong><strong><td>INR.' +bnbComission +'</td></strong><td>INR.' +discount +'</td><strong><td>INR.' +fimalComission +'</td></strong><td></d></tr>';                         
                                  $.each(data, function(k, v) {   
                                  document.getElementById('table_view').innerHTML +='<tr><td>' +v.date_of_order +'</td><td><img src="https://buynbragstores.s3.amazonaws.com/assets/images/stores/'+v.storeID+'/'+v.productID+'/img1_240x200.jpg" alt="Smiley facINR.e" height="80" width="80"> </td><td>' +v.productName +'</td><td>' +v.storeName +'</td><td>INR.' +v.TotalSellingPrice +'</td><td>INR.' +v.sellerEarning +'</td><td>INR.' +v.bnbCommissionValue +'</td><td>INR.' +v.couponsRedeemed +'</td><td>INR.' +v.finalCommission +'</td><td>' +v.pg_type +'</td></tr>';
                                  });
                                
                                  
                                }
                          }
                    });
                  }
          }
/*==========================================  CUSTOM PRODUCTS TABLE FUNCTION END =================================================*/         
</script>
<script>
/*==========================================================  DATEPICKER FUNCTION START =============================================*/
    $(function() {
    $('#startDate').datepicker({dateFormat: 'yy-mm-dd'});
    $('#endDate').datepicker({dateFormat: 'yy-mm-dd'});
     $('#startD').datepicker( {dateFormat:'yy-mm-dd' });
    $('#endD').datepicker({dateFormat: 'yy-mm-dd'} );
    $('#startDgraph').datepicker( {dateFormat:'yy-mm-dd' });
    $('#endDgraph').datepicker({dateFormat: 'yy-mm-dd'} );
    $('#startDateprod').datepicker({dateFormat: 'yy-mm-dd'} );
    $('#endDateprod').datepicker({dateFormat: 'yy-mm-dd'} );

  });
/*================================================  DATEPICKER FUNCTION END ====================================================*/
  </script>

<script type="text/javascript">
/*
   function showView(id) {
     $(".closebtn").click(function () {
        $(document.getElementById(id)).fadeOut("500");
        document.body.style.background = "white";
      });

        if (document.getElementById(id).style.visibility == 'hidden') {
           if (document.getElementById('chartMonth').style.visibility == '') {
                  document.getElementById('chartMonth').style.visibility = 'hidden';
                  document.body.style.background = "darkgrey";
                  $("#chartMonth").hide('800', "swing");
        }
        if (document.getElementById('box_id').style.visibility == '') {
                  document.getElementById('box_id').style.visibility = 'hidden';
                  document.body.style.background = "darkgrey";
                  $("#box_id").hide('800', "swing");
        }
         if (document.getElementById('graphdayBlock').style.visibility == '') {
                  document.getElementById('graphdayBlock').style.visibility = 'hidden';
                  document.body.style.background = "darkgrey";
                  $("#graphdayBlock").hide('800', "swing");
        }
         if (document.getElementById('chartMonth').style.visibility == '') {
                  document.getElementById('chartMonth').style.visibility = 'hidden';
                  document.body.style.background = "darkgrey";
                  $("#chartMonth").hide('800', "swing");
        }
        
        if (document.getElementById('weekid').style.visibility == '') {
                  document.getElementById('weekid').style.visibility = 'hidden';
                  document.body.style.background = "darkgrey";
                  $("weekid").hide('800', "swing");
        }
           
          document.getElementById(id).style.visibility = '';
          document.body.style.background = "darkgrey";
          $(document.getElementById(id)).hide();
        }
        $(document.getElementById(id)).show_custom_table(800, "swing");
        document.body.style.background = "darkgrey";
} */
</script>
<script type="text/javascript">
/*===========================================  ONCLICK POPUP FUNCTION START ===================================================*/
    function showView(id) 
    {
    $(document.getElementById(id)).bPopup({
            easing:'linear',
            speed: 500,
            escClose: true,
            transition: 'fadeIn'
            });
    }
/*==============================================  ONCLICK POPUP FUNCTION END  ==================================================*/
</script>
<script>
/*============================================  DATE FILTER GRAPH FUNCTION START ================================================*/
    function show_date_graph()
{

       var x = document.getElementById("startD");
        var start = x.value;
        alert(start);
        var x = document.getElementById("endD");
        var end = x.value;
         var x = document.getElementById("datatypeDay");
        var datatypeDay = x.value;
     
     
        if (start==null || start=='' ) 
             {
                 alert("Please enter start Date");
                 return false;
             }
             else if (end==null || end=='' ) 
             {
                 alert("Please enter END Date");
                 return false;
             }
              else if (start >= end ) 
             {
                 alert("Please enter correct format");
                 return false;
             }
  
   else {
  
         $.ajax
                ({
                    url: "<?php echo $baseURL; ?>index.php/reportdetails/dailyData",
                    data: {start:start,end:end,datatypeDay:datatypeDay},
                    type: 'GET',
                   success :   function(data)
                   {
                     document.getElementById('graph_view').style.display = '';
                     document.getElementById('export').style.display = 'none';
                     document.getElementById('null_orders_view').style.display = 'none';
                    document.getElementById('table_view').style.display = 'none';
                     document.getElementById('landing_graph_data').style.display = 'none';
                      document.getElementById('landing_graph').style.display = 'none';
                    $(document.getElementById('graphdayBlock')).bPopup().close();

                  /*var re = $.parseJSON(data);*/
                    console.log(data.orderDate);
                         var series = [];
                                      var column =[];
                                        for (var i=0; i<data.value.length; i++){
                                          series.push({
                                              name: data.value[i].name,
                                              data:data.value[i].data
                                          });
                                            column .push({
                                              type: 'column',
                                              name: data.value[i].name,
                                              data:data.value[i].data
                                          });
                                      }

                     var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'graph_view',
                        defaultSeriesType: 'spline',
                        marginRight: 0,
                        marginBottom: 25
                    },
                    credits: {
                text: 'buynbrag.com',
                href: 'http://www.buynbrag.com'
                },
                    title: {
                        text: 'EARNING DETAIL',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'BUYNBRAG',
                        x: -20
                    },
                    xAxis: data.orderDate,
                    yAxis: {
                        title: {
                            text: 'Revanue'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        formatter: function() {
                                return '<b>'+ this.series.name +'</b><br/>'+
                                this.x +': '+ this.y +'rupee';
                        }
                    },
                    legend: {
                        
                        align: 'top',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
                    },
                    
                    series:series


                });

              }
           });
        }
     }   
/*================================================  DATE FILTER GRAPH FUNCTION END ===============================================*/
    </script>

  <script type = text/javascript>
  /*=============================================== LANDING GRAPH FUNCTION START =======================================================*/
        $(function () 
        {
         Highcharts.setOptions({
   colors: ["#0d233a","#e48f8f","#83b5e7","#9fa8b0"],
   chart: {
      backgroundColor: 
         '#d9edf6',
         
      
      borderWidth: 0,
      borderRadius: 15,
      plotBackgroundColor: null,
      plotShadow: false,
       marginBottom: 15,
       height: 500,
      plotBorderWidth: 0
   },
   title: {
      style: {
         color: '#283137',
         font: '16px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#d68686',
         font: '12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
      }
   },
   xAxis: {

       startOnTick:true,
        showFirstLabel: true,
        endOnTick : true,
        showLastLabel:true,     
     lineColor: '#000000',
      tickColor: '#000000',
      labels: {
         style: {
            color: '#283137',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#283137',
            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }            
      }
   },
   yAxis: {
    gridLineColor:"#C0C0C0",
      gridLineWidth:'1px',
      gridZIndex:1,
      alternateGridColor: null,
      
      
      lineWidth: 2,
      tickWidth: 1,
      labels: {
         style: {
            color: '#283137',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#283137',
            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }            
      }
   },
   legend: {
      itemStyle: {
         color: '#283137'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#9fa8b0'
      }
   },
   credits: {
      style: {
         right: '50px'
      }
   },
   labels: {
      style: {
         color: '#283137'
      }
   },
   tooltip: {
      backgroundColor: {
         linearGradient: [0, 0, 0, 50],
         stops: [
            [0, 'rgba(96, 96, 96, .8)'],
            [1, 'rgba(16, 16, 16, .8)']
         ]
      },
      borderWidth: 0,
      style: {
         color: '#FFF'
      }
   },
   toolbar: {
      itemStyle: {
         color: '#CCC'
      }
   }
}); 

  $.ajax
                ({
                    url: "<?php echo $baseURL; ?>index.php/reportdetails/lastSevenDays",
                    data: {},
                    type: 'GET',
                   success :   function(data){
                   
                                                               
                    /*var re = $.parseJSON(data);*/
                  
                     var lastdate = 0;
                                            for(var len = data.orderDate.categories.length, i=0; i < len; i++)
                                            { 
                                                lastdate = data.orderDate.categories[i]; 
                                               }
                                            
                                           
                   document.getElementById('landing_graph_data').innerHTML = '<h2>EARNING DETAIL FROM  '+data.orderDate.categories[0]+' To '+lastdate;
                    /* for (var i=0; i<re.value.length; i++) {
                      var value = re.value[i];
                      var name = value.name;
                      var dd = value.data;

                            //put into an array
                            arrayn.push(name,dd);
                            
                                       
                                      }  */

                                      var series = [];
                                      var column =[];
                                        for (var i=0; i<data.value.length; i++){
                                          series.push({
                                              name: data.value[i].name,
                                              data:data.value[i].data
                                          });
                                            column .push({
                                              type: 'column',
                                              name: data.value[i].name,
                                              data: data.value[i].data
                                          });
                                      }

                                                      
                    console.log(data.value[0].data);
                     var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'landing_graph',
                        defaultSeriesType: 'areaspline',
                        marginRight: 0,
                        marginBottom: 50,
                         zoomType: 'x'
                    },
                    credits: {
                text: 'buynbrag.com',
                href: 'https://www.buynbrag.com'
                },
                    title: {
                        text: 'EARNING DETAIL',
                        x: -20 
                    },
                    subtitle: {
                        text: 'BUYNBRAG',
                        x: -20
                    },
                    xAxis: 
                        data.orderDate,
                    yAxis: {
                        title: {
                            text: 'Revanue'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        formatter: function() {
                                return '<b>'+ this.series.name +'</b><br/>'+
                                this.x +':  Rs. '+ this.y;
                        }
                    },
                    legend: {
                        
                        align: 'top',
                        verticalAlign: 'top',
                        x: -10,
                        y: 40,
                        borderWidth: 0
                    },
                     plotOptions: {
                      series: {
                        shadow: true,
                cursor: 'pointer',
                events: {
                    click: function() {
                    
                    return  'Category: '+ this.category +',name:'+this.series.name+ ',value: '+ this.y ;
                    
                    }
                }
            },
                areaspline: {
                    
                    marker: {
                      cursor:"pointer",
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
                    
                   series: series
                   });
                }
      });
        
        });

  /*=============================================== LANDING GRAPH FUNCTION END ===================================================*/
        </script>
        <script type="text/javascript">
        $(function () 
        {

        });
        </script>
        <script type="text/javascript">
  /*=============================================CUSTOM MONTH TABLE FUNCTION START ===================================================*/
        function show_month_table() 
        {
             document.getElementById('null_orders_view').innerHTML = '';
             document.getElementById('table_view').innerHTML = "";
             var x = document.getElementById("month_list");
             var month = x.value;
             var y = document.getElementById("year_list");
             var year = y.value;
        
       if (month==null || month==''|| month ==0 ) 
   {
       alert("Please select month");
       return false;
   }
   else if (year==null || year ==''|| year== 0) 
   {
       alert("Please select Year");
       return false;
   }
   else {
   var date = year+'-'+month;
   $(document.getElementById('box_id')).bPopup().close();
         $.ajax
                ({
                    url: "<?php echo $baseURL; ?>index.php/reportdetails/monthlyReport",
                    data: {month: date},
                    type: 'GET',
                   success :   function(data){
                    
                    
                     //alert(data);
                       document.getElementById('graph_view').style.display = 'none';
                       document.getElementById('landing_graph_data').style.display = 'none';
                       document.getElementById('landing_graph').style.display = 'none';
                       document.getElementById('export').style.display = '';
                       document.getElementById('null_orders_view').style.display = 'none';
                       document.getElementById('table_view').style.display = '';
                       document.getElementById('table_view').innerHTML =' <tr><th>DATE OF ORDER</th> <th>PRODUCT IMAGE</th><th>PRODUCT NAME</th><th>STORE NAME</th><th>SELLING PRICE</th><th>SELLER EARNING</th><th>BNB COMMISSION</th> <th>SPECIAL DISCOUNT</th> <th>FINAL COMMISSION</th><th>PAYMENT TYPE</th>  </tr>';           
                            if(data == "{}"||data== null) 
                            {
                              console.log(data);
                              document.getElementById('export').style.display = 'none';
                              document.getElementById('table_view').style.display = 'none';
                              document.getElementById('null_orders_view').innerHTML += "</br><h2>NO RECORDS</h2>";
                         }

                       else{
                        
                         //
                         console.log(data);

                            
                                       var sellingsum = 0;
                                       var sellerEarning = 0;
                                       var bnbComission = 0;
                                       var discount = 0;
                                       var fimalComission = 0;
                                           for(var len = data.length, i=0; i < len; i++){ 
                                                var item = data[i]; 
                                                sellingsum += parseInt(item.TotalSellingPrice, 10);
                                                sellerEarning+= parseInt(item.sellerEarning, 10);
                                                bnbComission+= parseInt(item.bnbCommissionValue, 10);
                                                discount+= parseInt(item.couponsRedeemed, 10);
                                                fimalComission+= parseInt(item.finalCommission, 10);
                                                 
                                            } 
                             document.getElementById('table_view').innerHTML +='<tr style="font-weight: bolder;"><td ><strong><b>TOTAL</b></strong></td><td>No. Of Orders '+i+'</td><td></td><td></td><strong><td>INR.' +sellingsum +'</td></strong><strong><td>INR.' +sellerEarning +'</td></strong><strong><td>INR.' +bnbComission +'</td></strong><td>INR.' +discount +'</td><strong><td>INR.' +fimalComission +'</td></strong><td></d></tr>';               
                            $.each(data, function(k, v) {   
                            document.getElementById('table_view').innerHTML +='<tr><td>' +v.date_of_order +'</td><td><img src="https://buynbragstores.s3.amazonaws.com/assets/images/stores/'+v.storeID+'/'+v.productID+'/img1_240x200.jpg" alt="Smiley face" height="80" width="80"> </td><td>' +v.productName +'</td><td>' +v.storeName +'</td><td>INR.' +v.TotalSellingPrice +'</td><td>INR.' +v.sellerEarning +'</td><td>INR.' +v.bnbCommissionValue +'</td><td>INR.' +v.couponsRedeemed +'</td><td>INR.' +v.finalCommission +'</td><td>' +v.pg_type +'</td></tr>';
                            });
                             
                          }
                    }
              });
            }
          }
   /*=============================================  MONTH TABLE FUNCTION END =============================================*/              
</script>
<script type="text/javascript">
/*===============================================  WEEK GRAPH MODEL FUNCTION START ==============================================*/
 function show_week_graph()
{

       var x = document.getElementById("datatypeWeek");
        var datatype = x.value;
        var y = document.getElementById("week_list");
        var week = y.value;
        $(document.getElementById('weekid')).bPopup().close();
  
         $.ajax
                ({
                    url: "<?php echo $baseURL; ?>index.php/reportdetails/weeklyData",
                    data: {week:week,datatype:datatype},
                    type: 'GET',
                   success :   function(data)
                   {

                      
                     document.getElementById('graph_view').style.display = '';
                     document.getElementById('export').style.display = 'none';
                     document.getElementById('null_orders_view').style.display = 'none';
                    document.getElementById('table_view').style.display = 'none';
                     document.getElementById('landing_graph_data').style.display = 'none';
                      document.getElementById('landing_graph').style.display = 'none';
                    

                 /* var re = $.parseJSON(data); */
                    console.log(data);
                         var series = [];
                                      var column =[];
                                        for (var i=0; i<data.value.length; i++){
                                          series.push({
                                              name: data.value[i].name,
                                              data:data.value[i].data
                                          });
                                            column .push({
                                              type: 'column',
                                              name: data.value[i].name,
                                              data:data.value[i].data
                                          });
                                      }

                     var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'graph_view',
                        defaultSeriesType: 'spline',
                        marginRight: 0,
                        marginBottom: 50
                    },
                    credits: {
                text: 'buynbrag.com',
                href: 'http://www.buynbrag.com'
                },
                    title: {
                        text: 'EARNING DETAIL',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'BUYNBRAG',
                        x: -20
                    },
                    xAxis: data.orderDate,
                    yAxis: {
                        title: {
                            text: 'Revanue'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        formatter: function() {
                                return '<b>'+ this.series.name +'</b><br/>'+
                                this.x +': '+ this.y +'rupee';
                        }
                    },
                    legend: {
                        
                        align: 'top',
                        verticalAlign: 'top',
                        x: -10,
                        y: 40,
                        borderWidth: 0
                    },
                    
                    series:series


                });

              }
           });
        
     }   
/*===============================================  WEEK GRAPH MODEL FUNCTION END =================================================*/
</script>
<script>
/*============================================  MONTH FILTER GRAPH FUNCTION START ================================================*/
    function show_month_graph()
{

       var x = document.getElementById("datatypeMonth");
        var datatype = x.value;
        var y = document.getElementById("start_month_list");
        var startmonth = y.value;
        var z = document.getElementById("end_month_list");
        var endmonth = z.value;
         var e = document.getElementById("year_list1");
        var startYear = e.value;
        var v = document.getElementById("year_list2");
        var endYear = v.value;
         var Smonth = parseInt(startmonth);
          var Emonth = parseInt(endmonth);
     
        if (startmonth==null || startmonth==''|| startmonth == 0 ) 
             {
                 alert("Please enter start month");
                 return false;
             }
             else if (endmonth ==null ||endmonth =='' || endmonth  == 0 ) 
             {
                 alert("Please enter END month");
                 return false;
             }
              else if (startYear==null || startYear=='' || startYear == 0 ) 
             {
                 alert("Please select start year");
                 return false;
             }
              else if (endYear ==null || endYear =='' || endYear  == 0 ) 
             {
                 alert("Please select end year");
                 return false;
             }
             else if (startYear > endYear ) 
             {
                 alert("Please select correct year");
                 return false;
             }
             else if (Smonth>Emonth) 
             {
                 alert("Please select correct month");
                 return false;
             }
              
  
   else {
     var startDate =  startYear+'-'+startmonth;
      var endDate = endYear+'-'+endmonth;
      $(document.getElementById('chartMonth')).bPopup().close();
         $.ajax
                ({
                    url: "<?php echo $baseURL; ?>index.php/reportdetails/monthlyData",
                    data: {startDate:startDate,endDate:endDate,datatype:datatype},
                    type: 'GET',
                   success :   function(data)
                   {
                     document.getElementById('graph_view').style.display = '';
                     document.getElementById('export').style.display = 'none';
                     document.getElementById('null_orders_view').style.display = 'none';
                    document.getElementById('table_view').style.display = 'none';
                     document.getElementById('landing_graph_data').style.display = 'none';
                      document.getElementById('landing_graph').style.display = 'none';
                    

                 /* var re = $.parseJSON(data);*/
                    
                         var series = [];
                                      var column =[];
                                        for (var i=0; i<data.value.length; i++){
                                          series.push({
                                              name: data.value[i].name,
                                              data:data.value[i].data
                                          });
                                            column .push({
                                              type: 'column',
                                              name: data.value[i].name,
                                              data:data.value[i].data
                                          });
                                      }

                     var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'graph_view',
                        defaultSeriesType: 'spline',
                        marginRight: 0,
                        marginBottom: 50
                    },
                    credits: {
                text: 'buynbrag.com',
                href: 'http://www.buynbrag.com'
                },
                    title: {
                        text: 'EARNING DETAIL',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'BUYNBRAG',
                        x: -20
                    },
                    xAxis: data.orderDate,
                    yAxis: {
                        title: {
                            text: 'Revanue'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        formatter: function() {
                                return '<b>'+ this.series.name +'</b><br/>'+
                                this.x +': '+ this.y +'rupee';
                        }
                    },
                    legend: {
                        
                        align: 'top',
                        verticalAlign: 'top',
                        x: -10,
                        y: 40,
                        borderWidth: 0
                    },
                    
                    series:series


                });

              }
           });
        }
     }   
/*================================================  MONTH FILTER GRAPH FUNCTION END ===============================================*/
    </script>
    <script type="text/javascript">
  /*======================================  TOP SELLING PRODUCTS TABLE FUNCTION START =================================================*/
        function top_selling_table() 
        {
             document.getElementById('null_orders_view').innerHTML = '';
             document.getElementById('table_view').innerHTML = "";
            var s = document.getElementById("topSellingStore");
             var store = s.value;
             var c = document.getElementById("CatagoryTopSelling");
             var category = c.value;
             var x = document.getElementById("startDateprod");
             var start = x.value;
             var y = document.getElementById("endDateprod");
             var end = y.value;
                  
                  if (start==null || start=='' ) 
             {
                 alert("Please enter start Date");
                 return false;
             }
             else if (end==null || end=='' ) 
             {
                 alert("Please enter END Date");
                 return false;
             }
              else if (start >= end ) 
             {
                 alert("Please enter correct format");
                 return false;
             }
             else {
               $(document.getElementById('topSelling')).bPopup().close();
               $.ajax
                      ({
                          url: "<?php echo $baseURL; ?>index.php/reportdetails/topSelling",
                          data: {start:start,end:end,store:store,category:category},
                          type: 'GET',
                         success :   function(data){
                          
                          

                             document.getElementById('graph_view').style.display = 'none';
                              document.getElementById('landing_graph_data').style.display = 'none';
                             document.getElementById('landing_graph').style.display = 'none';
                             document.getElementById('null_orders_view').style.display = 'none';
                             document.getElementById('export').style.display = '';
                             
                             document.getElementById('table_view').style.display = '';
                              document.getElementById('table_view').innerHTML =' <tr><th>PRODUCT ID</th> <th>PRODUCT IMAGE</th><th>PRODUCT NAME</th><th>STORE ID</th><th>STORE NAME</th><th>TOTAL COUNT</th><th>TOTAL QUANTITY</th> <th>TOTAL SELLING PRICE</th></tr>';
                   
                                  if(data == "{}") 
                                  {
                                    
                                    document.getElementById('null_orders_view').innerHTML += "<h2>NO RECORDS</h2>";
                               }

                             else{
                              
                              
                               /*var table = $.parseJSON(data); */
                              
                                    
                                            
                                  $.each(data, function(k, v) 
                                  {   
                                   document.getElementById('table_view').innerHTML +='<tr><td>' +v.productID +'</td><td><img src="https://buynbragstores.s3.amazonaws.com/assets/images/stores/'+v.storeID+'/'+v.productID+'/img1_240x200.jpg" alt="product_image" height="80" width="80"> </td><td> <a href="https://buynbrag.com/product/'+v.productName +'/'+v.productID+'"target="_blank">'+v.productName +'</a></td><td>' +v.storeID +'</td><td>' +v.storeName +'</td><td>' +v.totalCount+'</td><td>' +v.totalQuantity +'</td><td>INR.' +v.TotalSellingPrice  +'</td></tr>';
                                  });
                                  
                                }
                          }
                    });
                  }
          }
/*==========================================  TOP SELLING PRODUCTS TABLE FUNCTION END =================================================*/         
</script>
    </head>
    <body>
    <!--------------------------------------------------------------HEADER-------------------------------------------------->
            <div class ="header">
                 SALES DASHBOARD   
                <!-- <img width="50"height="50"src="images/home.png" style="float: right;" background="no-repeat" background-color="#F4F4F7";> -->
            </div>
            <a href="<?php echo $baseURL; ?>index.php/crm" onClick='window.close()'> CRM Home </a>
 <!-----------------------------------------------------------CONTAINER------------------------------------------------------------>       
            <div id="container" style="width:100%">
 <!-------------------------------------------------------MENU MODEL START -------------------------------------------------------->           
            <div id="menu" style="height:500px;width:250px;float:left;">
            <ul class ="vertical-list">
                <li id="sales"><a href="#" onClick="landingView();" class="list"> SALES REPORT </a></li>
                <li id="monthly"><a href="#" class="sub"  tabindex="1">MONTHLY REPORT</a><img src="<?php echo $baseURL; ?>assets/img/up.gif" alt="" />
                    <ul>
                        <li><a href="#" onClick="showView('box_id');">SELECT MONTH</a></li>
                        
                    </ul>
                </li>
                <li><a href="#"onClick="showView('dlg');" class="list" tabindex="1">CUSTOM REPORT</a></li>
                <li><a href="#"class="sub" tabindex="1">CHARTS</a><img src="<?php echo $baseURL; ?>assets/img/up.gif" alt="" />
                   <ul>
                        <li><a href="#" onClick="showView('graphdayBlock');">DAILY</a></li>
                        <li><a href="#" onClick="showView('weekid');">WEEKLY</a></li>
                        <li><a href="#"onClick="showView('chartMonth');">MONTHLY</a></li>
                        
                    </ul>
                </li>
                <li><a href="#"onClick="showView('topSelling');" class="list" tabindex="1">TOP SELLING PRODUCTS</a>
                </li>
                
            </ul>

            </div>
  <!----------------------------------------------------------MENU MODEL FINISH-------------------------------------------->
  <!---------------------------------------------------------CONTENT MODEL START------------------------------------------------>
<div id="content" style="">

<div id="landing_graph" style=" float:left;width:970px;height:400px;margin-top: 16px;"></div>
<div id="landing_graph_data" style="float:left; color: black;text-indent: 220px;text-transform: uppercase;"></div>
<!--CUSTOM REPORT MODEL START-->
     <div class="cont" id="dlg"style="display=none">
      
      <div class="button b-close" title="Close" id="closeMbtn">x</div>
      <h2><center>CUSTOM REPORT</center></h2>
        <div class ="intern">
         <label for="Selectstore"class="storelabel">Store:</label>   <select class="storeName" id="storename">
         <option value="0">All</option>
</select>
<label for="StartCat"class="catlabel">Categories:</label>
         <select class="catNAME" id="Catagory">
         <option value="0">All</option>
          <option value="6">Furniture</option>
          <option value="8">Decor and Furnishing</option>
          <option value="7">Dining</option>
          <option value="10">Lighting</option>
          <option value="2">Fashion</option>
          <option value="4">Gift and Collectible</option>
          <option value="3">Art</option>
</select><br><br><br>
           <label for="StartD">Start Date:</label>
           <input type="text" id="startDate" placeholder="Start Date">
           <label for="EndD" class="endDate"> End Date:</label>
          <input type="text"id="endDate" class="endDate" placeholder="End Date"><br>
          <input type="submit"class="button" value="Submit" onclick = "show_custom_table()">
      
    </div>
    </div>
<!--CUSTOM REPORT MODEL FINISH-->
<!--MONTHLY REPORT MODEL START-->
     <div class="box" id="box_id"style="display=none">
       <div class="button b-close" title="Close" id="closeMbtn">x</div>
       <h2><center>MONTHLY REPORT </center></h2>
        <div class ="intern">
         <label for="StartMonth"class="monthlabel">Select Month:</label>
         <select id="month_list" style="float: left;">
         <option value="0">Month</option>
          <option value="01">January</option>
          <option value="02">February</option>
          <option value="03">March</option>
          <option value="04">April</option>
          <option value="05">May</option>
          <option value="06">June</option>
          <option value="07">July</option>
          <option value="08">August</option>
          <option value="09">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>

 
</select>
<label for="yearlaber"class="yearlabel">Select Year:</label>
         <select id="year_list">
         <option value="0">Year</option>
          <option value="2011">2011</option>
          <option value="2012">2012</option>
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
          <option value="2018">2019</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
</select>
          <input type="submit"class="button" value="Submit" onclick = "show_month_table()">
      </div>
   </div>
<!--MONTHLY REPORT MODEL FINISH-->
<!--DAY FILTER GRAPH MODEL START-->
     <div class="cont" id="graphdayBlock"style="display=none">
       <div class="button b-close" title="Close" id="closeMbtn">x</div>
       <h2><center>DAILY CHART</center></h2>
        <div class ="intern">
         <label for="Selectdata"class="datalabel">Data Type:</label>   <select class="datatype" id="datatypeDay">
          <option value="0">All</option>
          <option value="1">BNB_COMMISSION</option>
          <option value="2">SELLING PRICE</option>
          <option value="3">FINAL COMMISSION</option>
</select><br><br>
           <label for="StartD">Start Date:</label>
           <input type="text" id="startD" placeholder="Start Date">
           <label for="EndD" class="endD"> End Date:</label>
          <input type="text"id="endD" class="endD" placeholder="End Date"><br>
          <input type="submit"class="button" value="Submit" onclick = "show_date_graph()">
      </div>
      </div>
<!--DAY FILTER GRAPH MODEL END-->
<!--MONTH FILTER GRAPH MODEL START-->
    <div class="cont" id="chartMonth"style="display=none">
       <div class="button b-close" title="Close" id="closeMbtn">x</div>
       <h2><center>MONTHLY CHART</center></h2>
       <div class ="intern">
          <label for="Selectdata"class="datalabel">Data Type:</label>   <select class="datatype" id="datatypeMonth">
          <option value="0">All</option>
          <option value="1">BNB_COMMISSION</option>
          <option value="2">SELLING PRICE</option>
          <option value="3">FINAL COMMISSION</option>
          </select><br><br>
         <label for="StartMonth"class="start_month_label">Start Month:</label>
         <select id="start_month_list">
         <option value="0">Month</option>
        <option value="01">January</option>
         <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option> </select>
 <label for="EndMonth"class="end_month_label">End Month:</label>
         <select id="end_month_list">
                <option value="0">Month</option>
        <option value="01">January</option>
         <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option> 
         </select><br><br>
<label for="Year"class="yearlabel">Select Start Year:</label>
         <select id="year_list1" style="float: left;">
                 <option value="0">Year</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2019</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
           </select>
           <label for="Year"class="yearlabel">Select End Year:</label>
         <select id="year_list2">
                 <option value="0">Year</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2019</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
           </select>
          <input type="submit"class="button" value="Submit" onclick = "show_month_graph()">
      </div>
    </div>
<!--MONTH FILTER GRAPH MODEL END-->
<!--WEEK FILTER GRAPH MODEL START-->
      <div class="cont" id="weekid"style="display=none">
       <div class="button b-close" title="Close" id="closeMbtn">x</div>
       <h2><center>WEEKLY CHART</center></h2>
        <div class ="intern">
        <label for="Selectdata"class="datalabel" id="dataweek" style="margin-left: 9em;">Data Pick:</label>   <select id="datatypeWeek">
          <option value="0">All</option>
          <option value="1">BNB_COMMISSION</option>
          <option value="2">SELLING PRICE</option>
          <option value="3">FINAL COMMISSION</option>
          </select>  </br></br>
         <label for="WEEK"class="weeklabel">Select Week:</label>
         <select id="week_list">
          <option value="0">Current Week</option>
         <option value="1">Last 1 Week</option>
          <option value="2">Last 2 Week</option>
          <option value="3">Last 3 Week</option>
          <option value="4">Last 4 Week</option>
        </select>
       <input type="button"class="button" value="Submit" onclick = "show_week_graph()">
  
      </div>
    </div>
    <!--WEEK FILTER GRAPH MODEL START-->
    <!--CSV EXPORT MODEL START-->
    <div id="exportcsv"style="margin-top: 16px;margin-top:16px;padding:10px;text-transform:uppercase;"><a href="#" id="export" style="display:none;">Export CSV</a></div> <!--CSV EXPORT MODEL END-->
    <!--TABLE MODEL START -->
      <div id="csvData"style="">
        <table id="table_view" style="display:none;float:left"> 
     <tbody>
  </tbody>
</table></div>

<div id="null_orders_view" style="fontfont-size: x-large;color: #000000;"></div>
<!--TABLE MODEL END -->
<!--TOP SELLING MODEL START -->
 <div class="cont" id="topSelling"style="display=none">
       <div class="button b-close" title="Close" id="closeMbtn">x</div>
       <h2><center>TOP SELLING</center></h2>
        <div class ="intern">
           <label for="Selectdata"class="topProd" style="margin-right:45px;">Store:</label>   <select  id="topSellingStore" style="float: left;">
            <option value="0">ALL</option>
              </select>
              <label for="StartCat"class="catlabel">Categories:</label>
         <select class="catNAME" id="CatagoryTopSelling">
         <option value="0">All</option>
          <option value="6">Furniture</option>
          <option value="8">Decor and Furnishing</option>
          <option value="7">Dining</option>
          <option value="10">Lighting</option>
          <option value="2">Fashion</option>
          <option value="4">Gift and Collectible</option>
          <option value="3">Art</option>
</select><br><br>
             <label for="StartD">Start Date:</label>
             <input type="text" id="startDateprod" placeholder="Start Date">
             <label for="EndD" class="endD"> End Date:</label>
            <input type="text"id="endDateprod" class="endD" placeholder="End Date"><br>
            <input type="submit"class="button" value="Submit" onclick = "top_selling_table()">
        </div>
   </div>
   <!--TOP SELLING MODEL END -->
      <div id="graph_view"style=" width:1000px;height:400px;float:left;"></div>
      <div id="wait" style="display:none;border:0px;width:auto;height:autopx;position:absolute;top:50%;
      left:50%;right:50%;padding:2px;">
        <img src='<?php echo $baseURL; ?>assets/img/load1.gif' /><br></div>
</div>
</div>
 <!---------------------------------------------------------CONTENT MODEL END ------------------------------------------------>
</body>
</html>