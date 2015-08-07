<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        oTable = jQuery('#{{ $id }}').dataTable({

        @foreach ($options as $k => $o)
            {{ json_encode($k) }}: {{ json_encode($o) }},
        @endforeach



        @foreach ($callbacks as $k => $o)
            {{ json_encode($k) }}: {{ $o }},
        @endforeach



        });

        /*"fnClick": function (nButton, oConfig, oFlash) {
            var sData = this.fnGetSelectedData(oConfig);
            if(sData.length == 1) {
                var rowId = sData[0].rowId
                console.log (rowId);
            }
        }
        ;*/


        
        /*"fnClick": function (nButton, oConfig, oFlash) {
        var oTT = TableTools.fnGetInstance( 'meetings' );
        var aData = oTT.fnGetSelectedData();
        if ((aData[0].status == "Closed") || (aData[0].status == "Cancelled")) {
        console.log(aData);
        alert( "You cannot modify Closed or Cancelled Meetings" );
        return;
        }
        else {
        console.log(aData);
        //var data = meetings.row( 0 ).data();
        //alert(aData[0].DT_RowId);
        editor.edit( '#'+aData[0].DT_RowId+'', {
            title: 'Edit entry',
            buttons: 'Update',
        });
        return;
        }
        },*/


 /*       $ (Document) .ready (function () {
            $ ('# Ejemplo "). DataTable ({
                "CreatedRow": function (fila, los datos, el índice) {
                    if (datos [5] .replace (/ [\ $,] / g, '') * 1> 4000) {
                        $ ('Td', fila) .EQ (5) .addClass ('highlight');
                    }
                }
            });
        });
*/
        /*var oTT = TableTools.fnGetInstance( 'dtdefault' );
        alert(oTT.fnGetSelectedData());*/
        

                /*var href = "${pageContext.request.contextPath}/admin/my_home.jsp?rowId=" + rowId;
                $('#ui-tabs-2').load(href);
                return false;*/
            
    // custom values are available via $values array
    });
</script>
