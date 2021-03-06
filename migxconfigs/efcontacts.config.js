{
  "id":3,
  "name":"efcontacts",
  "formtabs":[
    {
      "MIGX_id":1,
      "caption":"Contact Point",
      "print_before_tabs":"0",
      "fields":[
        {
          "MIGX_id":1,
          "field":"name",
          "caption":"Name",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":2,
          "field":"category",
          "caption":"Category",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":3,
          "field":"phone",
          "caption":"Phone",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":4,
          "field":"email",
          "caption":"Email",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":5,
          "field":"street",
          "caption":"Street Address",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":6,
          "field":"city",
          "caption":"City",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":7,
          "field":"state",
          "caption":"State or Province",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"Alaska==AK||Alabama==AL||Arkansas==AR||Arizona==AZ||California==CA||Colorado==CO||Connecticut==CT||D.C.==DC||Delaware==DE||Florida==FL||Georgia==GA||Hawaii==HI||Iowa==IA||Idaho==ID||Illinois==IL||Indiana==IN||Kansas==KS||Kentucky==KY||Louisiana==LA||Massachusetts==MA||Maryland==MD||Maine==ME||Michigan==MI||Minnesota==MN||Missouri==MO||Marianas==MP||Mississippi==MS||Montana==MT||North Carolina==NC||North Dakota==ND||Nebraska==NE||New Hampshire==NH||New Jersey==NJ||New Mexico==NM||Nevada==NV||New York==NY||Ohio==OH||Oklahoma==OK||Oregon==OR||Pennsylvania==PA||Puerto Rico==PR||Rhode Island==RI||South Carolina==SC||South Dakota==SD||Tennessee==TN||Texas==TX||Utah==UT||Virginia==VA||Virgin Islands==VI||Vermont==VT||Washington==WA||Wisconsin==WI||West Virginia==WV||Wyoming==WY||Alberta==AB||British Columbia==BC||Manitoba==MB||New Brunswick==NB||Newfoundland and Labrador==NL||Northwest Territories==NT||Nova Scotia==NS||Nunavut==NU||Ontario==ON||Prince Edward Island==PE||Quebec==QC||Saskatchewan==SK||Yukon==YT",
          "default":""
        },
        {
          "MIGX_id":8,
          "field":"zip",
          "caption":"Zip or Postal Code",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"[]",
          "inputOptionValues":"",
          "default":""
        }
      ]
    }
  ],
  "contextmenus":"update||duplicate||recall_remove_delete",
  "actionbuttons":"addItem",
  "columnbuttons":"activate||deactivate",
  "filters":[
    {
      "MIGX_id":1,
      "name":"search",
      "label":"",
      "emptytext":"",
      "type":"textbox",
      "getlistwhere":"",
      "getcomboprocessor":"",
      "combotextfield":"",
      "comboidfield":"",
      "comboparent":"",
      "default":""
    }
  ],
  "extended":{
    "migx_add":"Add Contact Point",
    "formcaption":"Contact Points",
    "update_win_title":"",
    "win_id":"efcontacts",
    "maxRecords":"",
    "multiple_formtabs":"",
    "extrahandlers":"",
    "packageName":"eloquaforms",
    "classname":"efContact",
    "task":"contact",
    "getlistsort":"",
    "getlistsortdir":"",
    "use_custom_prefix":"0",
    "prefix":"",
    "grid":"",
    "gridload_mode":2,
    "check_resid":"0",
    "check_resid_TV":"",
    "join_alias":"",
    "getlistwhere":"",
    "joins":"",
    "cmpmaincaption":"",
    "cmptabcaption":"",
    "cmptabdescription":"",
    "cmptabcontroller":"",
    "winbuttons":"",
    "onsubmitsuccess":"",
    "submitparams":""
  },
  "columns":[
    {
      "MIGX_id":1,
      "header":"ID",
      "dataIndex":"id",
      "width":10,
      "sortable":true,
      "show_in_grid":1,
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":"[]"
    },
    {
      "MIGX_id":2,
      "header":"Name",
      "dataIndex":"name",
      "width":60,
      "sortable":true,
      "show_in_grid":1,
      "renderer":"this.renderRowActions",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":"[]"
    },
    {
      "MIGX_id":6,
      "header":"",
      "dataIndex":"deleted",
      "width":"",
      "sortable":"false",
      "show_in_grid":"0",
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":"[]"
    },
    {
      "MIGX_id":7,
      "header":"Active on This Form",
      "dataIndex":"contactPoint_active",
      "width":50,
      "sortable":"false",
      "show_in_grid":1,
      "renderer":"this.renderCrossTick",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":"[]"
    },
    {
      "MIGX_id":8,
      "header":"Active",
      "dataIndex":"Joined_active",
      "width":"",
      "sortable":"false",
      "show_in_grid":"0",
      "renderer":"this.renderCrossTick",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":"[]"
    },
    {
      "MIGX_id":9,
      "header":"Phone",
      "dataIndex":"phone",
      "width":60,
      "sortable":true,
      "show_in_grid":1,
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":"[]"
    },
    {
      "MIGX_id":10,
      "header":"Email",
      "dataIndex":"email",
      "width":80,
      "sortable":true,
      "show_in_grid":1,
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":"[]"
    }
  ],
  "createdby":1,
  "createdon":"2013-07-11 10:41:49",
  "editedby":1,
  "editedon":"2013-07-12 12:09:44",
  "deleted":0,
  "deletedon":"-1-11-30 00:00:00",
  "deletedby":0,
  "published":1,
  "publishedon":"-1-11-30 00:00:00",
  "publishedby":0
}