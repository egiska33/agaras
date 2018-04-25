module.exports = {
    capitalizeFirstChar: ( string ) => {
        string = string.replace(/\s+/g,' ').trim();
        var wordsArr = string.split(' ');

        for(var i = 0; i < wordsArr.length; i++)
        {
            wordsArr[i] = wordsArr[i].substring(0, 1).toUpperCase() + wordsArr[i].substring(1, wordsArr[i].length);
        }

        return wordsArr.join(' ');
    },

    getTotalElementsToPrint: (_) => {
        _.totalElementsToPrint = $("#innerDocContainer").children().length + $(".hugeTable tbody tr").length;
    },

    setVisibleElements: (_) => {
        var cuttingHeight = 2070;
        var forceHiddenNextAll = false;
        let tableRowsLeft = $(".hugeTable tbody tr").length;

        $("#innerDocContainer").children().each((i, elem) => {
            var $elem = $(elem);

            if($elem.hasClass('hugeTable'))
            {
                var $tableRows = $elem.find('tbody tr');

                if($tableRows.length == 0)
                {
                    $elem.remove();
                    _.totalElementsToPrint--;
                    return false;
                }

                $tableRows.each((i, row) => {
                    var $row = $(row);
                    var elemBottomOffset = $row.outerHeight() + $row.offset().top;

                    if(elemBottomOffset > cuttingHeight)
                    {
                        $row.addClass('preRenderHidden');
                        $row.nextUntil('.newPage').addClass('preRenderHidden');
                        forceHiddenNextAll = true;
                        return false;
                    }
                    else
                    {
                        tableRowsLeft--;
                        if(tableRowsLeft == 0) $elem.addClass('deleteAfterRender');

                        $row.addClass('deleteAfterRender');
                    }
                });
            }
            else
            {
                if(!forceHiddenNextAll)
                {
                    var elemBottomOffset = $elem.outerHeight() + $elem.offset().top;

                    if(elemBottomOffset > cuttingHeight)
                    {
                        $elem.addClass('preRenderHidden');
                        $elem.nextUntil('.newPage').addClass('preRenderHidden');
                        return false;
                    }
                    else $elem.addClass('deleteAfterRender');
                }
                else
                {
                    $elem.addClass('preRenderHidden');
                    $elem.nextUntil('.newPage').addClass('preRenderHidden');
                    return false;
                }
            }
        });
    },

    snapScreen: (_) => {
        $(() => {
            var domElement = $("#innerDocContainer")[0];

            if(_.totalElementsToPrint > 0)
            {
                module.exports.setVisibleElements(_);

                _.totalElementsToPrint -= $('.deleteAfterRender').length;

                domElement.style.fontFeatureSettings = '"liga" 0';

                html2canvas(domElement, {
                    width: 1500,
                    height: 2065
                }).then(function(canvas) {
                    var img = canvas.toDataURL('image/jpg');
                    _.docImgs.push(img);

                    $(".deleteAfterRender").remove();
                    $(".preRenderHidden").removeClass('preRenderHidden');
                    module.exports.snapScreen(_);
                });
            }
            else
            {
                module.exports.putImagesToPages(_);
            }
        });
    },

    putImagesToPages: (_) => {
        var doc = new jsPDF('p', 'pt', 'a4', true);
        if(_.docImgs[_.docImgs.length - 1] == _.docImgs[_.docImgs.length - 2]) _.docImgs.pop();

        doc.addImage(_.docImgs[0], "JPEG", 20, 20, 570, 760, undefined, 'FAST');

        for(var i = 1; i < _.docImgs.length; i++)
        {
            doc.addPage();
            doc.addImage(_.docImgs[i], "JPEG", 20, 20, 570, 760, undefined, 'FAST');
        }

        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + "-" +
                        + (currentdate.getMonth()+1)  + "-"
                        + currentdate.getDate() + " "
                        + currentdate.getHours() + ":"
                        + currentdate.getMinutes() + ":"
                        + currentdate.getSeconds();

        doc.save(datetime);
        formURL('/o/documents');
    },

    setVisibleElementsPrint: (_) => {
        var cuttingHeight = 2070;
        var forceHiddenNextAll = false;
        let tableRowsLeft = $(".hugeTable tbody tr").length;

        $("#innerDocContainer").children().each((i, elem) => {
            var $elem = $(elem);

            if(($elem.find('tbody tr').length == 0) && ($elem.hasClass('hugeTable')))
            {
                $elem.remove();
                _.totalElementsToPrint--;
                return true;
            }

            if($elem.hasClass('newPage'))
            {
                $elem.addClass('deleteAfterRender');
                $elem.nextAll('.newPage').addClass('preRenderHidden');
                return false;
            }
            else if($elem.hasClass('hugeTable'))
            {
                var $tableRows = $elem.find('tbody tr');

                if($tableRows.length == 0)
                {
                    $elem.remove();
                    _.totalElementsToPrint--;
                    return true;
                }

                $tableRows.each((i, row) => {
                    var $row = $(row);
                    var elemBottomOffset = $row.height() + $row.offset().top;

                    if(elemBottomOffset > cuttingHeight)
                    {
                        $row.addClass('preRenderHidden');
                        $row.nextAll().addClass('preRenderHidden');
                        $elem.nextAll().addClass('preRenderHidden');
                        return false;
                    }
                    else
                    {
                        tableRowsLeft--;
                        if(tableRowsLeft == 0)$elem.addClass('deleteAfterRender');

                        $row.addClass('deleteAfterRender');
                    }
                });
            }
            else
            {
                var elemBottomOffset = $elem.height() + $elem.offset().top;

                if(elemBottomOffset > cuttingHeight)
                {
                    $elem.addClass('preRenderHidden');
                    $elem.nextUntil('.newPage').addClass('preRenderHidden');
                    return false;
                }
                else $elem.addClass('deleteAfterRender');
            }
        });
    },

    leftPad: (number) => {
        var twodigit = number >= 10 ? number : "0"+number.toString();
        return twodigit;
    },

    snapScreenPrint: (_) => {
        var domElement = $("#innerDocContainer")[0];
        if(_.totalElementsToPrint > 0)
        {
            module.exports.setVisibleElementsPrint(_);

            _.totalElementsToPrint -= $('.deleteAfterRender').length;
            if($("#innerDocContainer").children().length != 0)
            {
                html2canvas(domElement, {
                    width: 1500,
                    height: 2065
                }).then(function(canvas) {
                    var img = canvas.toDataURL('image/jpg');
                    _.docImgs.push(img);

                    $(".deleteAfterRender").remove();
                    $(".preRenderHidden").removeClass('preRenderHidden');
                    module.exports.snapScreenPrint(_);
                });
            }
            else module.exports.snapScreenPrint(_);
        }
        else
        {
            module.exports.putImagesToPages(_);
        }
    }
}
