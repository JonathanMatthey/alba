(function(a){a(document).ready(function(){var d={fontset:"",branding:{}};var g={init:function(){a(".branding-bg-color").wpColorPicker(b);if(a(".semplice-content").val()){a(".loader").show();d=a.parseJSON(a(".rom").val());var m=a(".fontset").val();if(d.branding===undefined){d.branding={}}a("#semplice-content").css({"background-color":d.branding["background-color"],"background-image":"url("+d.branding["background-image"]+")","background-size":d.branding["background-size"],"background-position":d.branding["background-position"],"background-repeat":d.branding["background-repeat"]});if(d.branding["background-image"]){a(".branding-bg-image-preview").attr("src",d.branding["background-image"]).show();a("input[name=branding-bg-image]").val(d.branding["background-image"])}a("#semplice-content").children("#content-holder").remove();a("#semplice-content").append(a(".semplice-content").val());a(".is-masonry").each(function(){var n=a(this).attr("id");if(n!==undefined){a("#"+n).masonry()}});a(".image-link").click(function(n){return false});if(m!=="default"){a(".custom-fontset").find("option").each(function(){if(a(this).val()===m){a(this).attr("selected","selected")}else{a(this).removeAttr("selected")}});g.customFontset(m)}else{if(default_fontset){g.customFontset(default_fontset)}else{g.customFontset()}}a(".loader").fadeOut("slow")}else{if(default_fontset){g.customFontset(default_fontset)}else{g.customFontset()}a("#semplice-content").html("");a("#semplice-content").append('<div id="content-holder"></div>')}},add:function(r){a(".loader").show();var m=h("content");var q="#"+m;var n=a(r).data("content-type");var p={"background-color":"transparent","background-image":"","background-size":"none","background-position":"50% 0%","background-repeat":"no-repeat","padding-top":"0px","padding-bottom":"0px","padding-right":"0px","padding-left":"0px"};if(n==="content-thumbnails"&&a("#semplice").find(".content-thumbnails").length>0){alert("You can only add 1 Thumbnail View per Page");a(".loader").fadeOut("slow");return false}if(n==="multi-column"){d[q]={columns:{},styles:{}}}else{d[q]={styles:{}}}d[q].styles=p;var o=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",id:m,content_type:n,edit_mode:"new",rom:d[q]},dataType:"html"});o.done(function(s){a("#content-holder").append(s);a(q).find(".color-picker").wpColorPicker(l);a(q).find(".wp-picker-default").remove();a(q).find(".padding-left, .padding-right").remove();if(n==="multi-column"){a(q).find(".save").attr("class","save-mc");j()}a(q).addClass("in-edit-mode");a(q).find(".fadein").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein")});a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(q).offset().top-100},0)});o.fail(function(s,t){alert("Request failed: "+t);a(".loader").fadeOut("slow")})},addColumn:function(q){a(".loader").show();var p="#"+a(q).data("content-id");var m=h("column");var o="#"+m;var n=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",id:m,parent_id:p,content_type:"add-column",edit_mode:"new"},dataType:"html"});n.done(function(r){a(p).find(".columns").append(r);a(o).find(".save").remove();a(o).find(".fadein").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein")});a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(o).offset().top-100},0)});n.fail(function(r,s){alert("Request failed: "+s);a(".loader").fadeOut("slow")})},addColumnContent:function(t){a(".loader").show();var m="#"+(t).data("content-id");var n=h("column_content");var r="#"+(t).data("column-id");var s="#"+n;var o=a(t).data("content-type");var q={"background-color":"transparent","background-image":"","background-size":"none","background-position":"50% 0%","background-repeat":"no-repeat","padding-top":"0px","padding-bottom":"0px","padding-right":"0px","padding-left":"0px"};if(d[m].columns[r]===undefined){d[m].columns[r]={}}d[m].columns[r][s]={styles:{}};d[m].columns[r][s].styles=q;var p=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",id:n,ccId:m,content_type:o,rom:d[m],column_id:r,edit_mode:"new",is_column_content:true},dataType:"html"});p.done(function(u){a(r).find(".column-inner").append(u);a(s).find(".save").remove();a(s).prev(".placeholder").remove();a(s).find(".color-picker").wpColorPicker(l);a(s).find(".wp-picker-default").remove();a(s).addClass("in-edit-mode");a(s).find(".fadein").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein")});a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(s).offset().top-140},0)});p.fail(function(u,v){alert("Request failed: "+v);a(".loader").fadeOut("slow")})},save:function(r){a(".loader").show();var n=a(r).data("content-id");var q="#"+a(r).data("content-id");var o=a(r).data("content-type");var m;d[q]={content:"",styles:{},options:{},content_type:o};a(q).find(".is-content").each(function(){d[q].content=a(this).val();if(a(this).val().length===0){m=true}});a(q).find(".is-option").each(function(){d[q].options[a(this).attr("name")]=a(this).val()});a(q).find(".is-style").each(function(){d[q].styles[a(this).attr("name")]=a(this).val()});d[q].styles["background-color"]=f(d[q].styles["background-color"]);if(!m){var p=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",id:n,content_type:o,rom:d[q]},dataType:"html"});p.done(function(s){a(q).append(s);a("#semplice").on("click",".save",k);a(q).find(".edit-content").remove();a(q).removeClass("in-edit-mode");a(q).find(".fadein-view").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein-view")});console.log(d[q]);a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(q).offset().top-100},0)});p.fail(function(s,t){alert("Request failed: "+t);a("#semplice").on("click",".save",k);a(".loader").fadeOut("slow")})}else{alert("Please add some content before save!");a("#semplice").on("click",".save",k);a(".loader").fadeOut("slow")}},saveSingleEdit:function(p){a(".loader").show();var u="#"+a(p).data("container-id");var t=a(p).data("container-id");var s=a(p).data("content-id");var n="#"+a(p).data("content-id");var m=a(p).data("column-id");var q=a(p).data("content-type");var r;a(n).find(".is-content").each(function(){d[u].columns[m][n].content=a(this).val();if(a(this).val().length===0){r=true}});a(n).find(".is-cc-option").each(function(){d[u].columns[m][n].options[a(this).attr("name")]=a(this).val()});a(n).find(".is-cc-style").each(function(){d[u].columns[m][n].styles[a(this).attr("name")]=a(this).val()});d[u].columns[m][n].styles["background-color"]=f(d[u].columns[m][n].styles["background-color"]);if(!r){var o=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",id:t,rom:d[u],content_type:"multi-column"},dataType:"html"});o.done(function(v){a(u).find(n).remove();a(u).append(v);a("#semplice").on("click",".save-se",c);a(u).removeClass("in-edit-mode");a(u).find(".fadein-view").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein-view")});a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(u).offset().top-100},0)});o.fail(function(v,w){alert("Request failed: "+w);a("#semplice").on("click",".save-se",c);a(".loader").fadeOut("slow")})}else{alert("Please add some content before save!");a("#semplice").on("click",".save-se",c);a(".loader").fadeOut("slow")}},saveColumnContent:function(r){a(".loader").show();var n=a(r).data("content-id");var q="#"+a(r).data("content-id");var m;var o=a(r).data("content-type");d[q]={columns:{},styles:{},options:{},content_type:o};a(q).find(".is-option").each(function(){d[q].options[a(this).attr("name")]=a(this).val()});a(q).find(".is-style").each(function(){d[q].styles[a(this).attr("name")]=a(this).val()});d[q].styles["background-color"]=f(d[q].styles["background-color"]);a(q).find(".column").each(function(){var s="#"+a(this).attr("id");d[q].columns[s]={options:{}};a(a(this)).find(".is-option").each(function(){d[q].columns[s].options[a(this).attr("name")]=a(this).val()});a(this).find(".column-content").each(function(){var w=a(this);var v="#"+a(this).data("content-id");var u="#"+a(this).data("in-column");var t=a(this).data("content-type");d[q].columns[u][v]={content:{},styles:{},options:{},content_type:t};a(this).find(".is-content").each(function(){d[q].columns[u][v].content=a(this).val();if(a(this).val().length===0){m=true}});a(this).find(".is-cc-option").each(function(){d[q].columns[u][v].options[a(this).attr("name")]=a(this).val()});a(this).find(".is-cc-style").each(function(){d[q].columns[u][v].styles[a(this).attr("name")]=a(this).val()});d[q].columns[u][v].styles["background-color"]=f(d[q].columns[u][v].styles["background-color"])})});if(a(q).find(".column").length!==0&&a(q).find(".column-content").length!==0&&!m){var p=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",id:n,rom:d[q],content_type:o},dataType:"html"});p.done(function(s){a(q).append(s);a("#semplice").on("click",".save-mc",e);a(q).find(".edit-content").remove();a(q).removeClass("in-edit-mode");a(q).find(".fadein-view").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein-view")});a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(q).offset().top-100},0)});p.fail(function(s,t){alert("Request failed: "+t);a("#semplice").on("click",".save-mc",e);a(".loader").fadeOut("slow")})}else{alert("Please add a column and a column content before save.");a("#semplice").on("click",".save-mc",e);a(".loader").fadeOut("slow")}},edit:function(q){a(".loader").show();j();var m=a(q).data("content-id");var p="#"+a(q).data("content-id");var n=a(q).data("content-type");var o=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",edit_mode:"edit",id:m,content_type:n,rom:d[p]},dataType:"html"});console.log(d[p]);o.done(function(r){a(p).append(r);if(n==="multi-column"){a(p).find(".mc-content-container").remove()}else{a("#semplice").on("click",".content-container",i);a(p).find(".content-container").remove()}a(p).find("input[name=background-image]").each(function(){if(a(this).val()){a(this).next().show()}});if(a("input[name=img]").val()){a(p).find("img.image-preview").show()}a(p).find(".color-picker").wpColorPicker(l);a(p).find(".wp-picker-default").remove();if(n==="multi-column"){a(p).find(".save").attr("class","save-mc");a(p).find(".padding-left").first().remove();a(p).find(".padding-right").first().remove()}else{a(p).find(".padding-left, .padding-right").remove()}a(p).find(".fadein").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein")});a(p).addClass("in-edit-mode");a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(p).offset().top-100},0)});o.fail(function(r,s){alert("Request failed: "+s);if(n!=="multi-column"){a("#semplice").on("click",".content-container",i)}a(".loader").fadeOut("slow")})},singleEdit:function(n,t){a(".loader").show();var s="#"+a(n).data("content-id");var p=a(t).data("single-edit-column-id");var q=a(t).data("single-edit-content-id");var r="#"+a(t).data("single-edit-content-id");var m=a(t).data("single-edit-content-type");var o=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",edit_mode:"single-edit",id:q,ccId:s,column_id:p,content_type:m,rom:d[s].columns[p][r]},dataType:"html"});o.done(function(u){a(s).append(u);a(s).find(".mc-content-container").remove();a(s).find("input[name=background-image]").each(function(){if(a(this).val()){a(this).next().show()}});if(a("input[name=img]").val()){a(s).find("img.image-preview").show()}a(s).find(".color-picker").wpColorPicker(l);a(s).find(".wp-picker-default").remove();a(r).find(".fadein").transition({opacity:1},500,"ease",function(){a(this).removeClass("fadein")});a(s).addClass("in-edit-mode");a(".loader").fadeOut("slow");a(a.browser.webkit?"body":"html").animate({scrollTop:a(s).offset().top-100},0)});o.fail(function(u,v){alert("Request failed: "+v);a(".loader").fadeOut("slow")})},remove:function(n){var m="#"+a(n).data("content-id");a(m).transition({opacity:0,marginTop:-40},400,"ease",function(){delete d[m];a(m).remove()})},removeColumn:function(o){var n="#"+a(o).data("content-id");var m=a(o).data("parent-id");a(n).transition({opacity:0,marginTop:-40},400,"ease",function(){if(d[m]!==undefined){delete d[m][n]}a(n).remove()})},up:function(o){var n="#"+a(o).data("content-id");var m=a(n).prev().attr("id");a(n).insertBefore("#"+m);a(a.browser.webkit?"body":"html").animate({scrollTop:a(n).offset().top-100},0)},down:function(o){var n="#"+a(o).data("content-id");var m=a(n).next().attr("id");a(n).insertAfter("#"+m);a(a.browser.webkit?"body":"html").animate({scrollTop:a(n).offset().top-100},0)},removeMedia:function(o,m){var n="#"+a(o).data("content-id");a(n).find(".is-"+m).val("");a(n).find("."+m+"-upload").text("Upload "+m);a(n).find("."+m+"-preview").attr("src","");a(n).find("."+m+"-preview").hide();if(m==="branding-bg-image"){a(n).find(".is-"+m).val("");a("#semplice-content").css("background-image","none");d.branding["background-image"]=""}},removeBg:function(n){var m="#"+a(n).data("content-id");a(m).find(".is-bg-image").val("");a(m).find(".bg-upload").text("Upload Image");a(m).find(".bg-preview").attr("src","");a(m).find(".bg-preview").hide()},customFontset:function(n){var m=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",edit_mode:"custom-fontset",fontset_id:n},dataType:"html"});m.done(function(o){if(!n){d.fontset="default"}else{d.fontset=n}a("[data-fontset-id=ce-fontset]").remove();a("#ce-fontset").remove();a("head").append(o);a(".loader").fadeOut("slow")});m.fail(function(o,p){alert("Request failed: "+p);a(".loader").fadeOut("slow")})},loadPreset:function(m){a(".loader").show();a(".presets-panel").fadeOut(250,function(){var n=a.ajax({url:ajaxurl,type:"POST",data:{action:"semplice_ce_ajax",edit_mode:"load-preset",preset_id:m},dataType:"json"});n.done(function(o){a("#semplice-content").html(o.html);d=a.parseJSON(o.rom);if(d.branding===undefined){d.branding={}}d.branding=a.parseJSON(o.branding);a("#semplice-content").css({"background-color":d.branding["background-color"],"background-image":"url("+d.branding["background-image"]+")","background-size":d.branding["background-size"],"background-position":d.branding["background-position"],"background-repeat":d.branding["background-repeat"]});a(".branding-bg-color").val(d.branding["background-color"]);a(".branding-sub .wp-color-result").css("backgroundColor",d.branding["background-color"]);var p=[d.branding["background-size"],d.branding["background-position"],d.branding["background-repeat"]];var q=0;a(".branding-sub .select-box").each(function(){var r=p[q];a(this).find("option").each(function(){if(a(this).val()===r){a(this).attr("selected","selected")}else{a(this).removeAttr("selected")}});q++});if(d.branding["background-image"]){a(".branding-bg-image-preview").attr("src",d.branding["background-image"]).show();a("input[name=branding-bg-image]").val(d.branding["background-image"])}a(".loader").fadeOut("slow");a(".overlay").fadeIn(150);a(".no-images").fadeIn(250)});n.fail(function(o,p){alert("Request failed: "+p);a(".loader").fadeOut("slow")})})},showLayers:function(o){a(".options-sub .show-layers").addClass("checked");var n=(o).data("content-id");a("#semplice").addClass("show-all-layers");a(".content-container, .mc-content-container").hide();a("#content-holder").sortable({axis:"y",cancel:".edit-content, .top-layer"});var m;a("#content-holder > div").each(function(){var s=false;var t="";var u="#"+a(this).attr("id");var p=a(this).attr("id");var r=a(this).children(".content-container, .mc-content-container").attr("data-content-type");if(a(this).hasClass("in-edit-mode")){a(this).find(".edit-content").hide();a(this).addClass("layer-mode");s="edit";t="In edit mode"}if(d[u].options===undefined){var q=a(this).find('input[name="layer-name"]').val()}else{var q=d[u].options["layer-name"]}if(n==p){a(this).append('<div class="layer"><div class="icon"></div><p class="layer-name">'+q+'</p><a class="edit-layer" data-content-id="'+p+'" data-content-type="'+r+'" data-edit-mode="'+s+'"></a><a class="remove" data-content-id="'+p+'"></a><p class="in-edit-mode">'+t+'</p><div class="active-layer"></div><div class="drag-icon"></div>');m=u}else{a(this).append('<div class="layer"><div class="icon"></div><p class="layer-name">'+q+'</p><a class="edit-layer" data-content-id="'+p+'" data-content-type="'+r+'" data-edit-mode="'+s+'"></a><a class="remove" data-content-id="'+p+'"></a><p class="in-edit-mode">'+t+'</p><div class="drag-icon"></div>')}a(this).children(".layer").stop().fadeIn(300)});a("#semplice-content").prepend('<div class="layer top-layer hide-layers" data-content-id="'+n+'"><div class="icon"></div><p class="layer-name">Back to edit mode</p></div>');a(".top-layer").fadeIn(300);if(m){a(a.browser.webkit?"body":"html").animate({scrollTop:a(m).offset().top-150},0)}a(o).addClass("checked")},hideLayers:function(q,m){a(".options-sub .show-layers").removeClass("checked");var p=a(q).data("content-id");var o=a(q).data("edit-mode");var n=a(q).data("content-type");a("#semplice").removeClass("show-all-layers");a(".content-container, .mc-content-container").show();a("#content-holder > div").each(function(){a(this).children(".layer").remove();if(a(this).hasClass("in-edit-mode")){a(this).find(".edit-content").show();a(this).removeClass("layer-mode")}});a(".top-layer").remove();a("#content-holder").sortable("destroy");if(m&&o!=="edit"){if(n!=="multi-column"){a("#semplice").off("click",".content-container")}g.edit(q)}else{if(p!=="undefined"){a(a.browser.webkit?"body":"html").animate({scrollTop:a("#"+p).offset().top-100},0)}}},saveToWp:function(){a("head").find("[data-fontset-id=ce-fontset]").each(function(){a(this).remove()});a("#ce-fontset").remove();var u=a("#semplice-content").html();a(".semplice-content").val(u);d.branding={"background-color":a(".branding-bg-color").val(),"background-image":a(".branding-bg-image").val(),"background-size":a(".branding-bg-size").val(),"background-position":a(".branding-bg-pos").val(),"background-repeat":a(".branding-bg-repeat").val()};if(d.fontset.length===0){d.fontset="default"}a(".fontset").val(d.fontset);a(".rom").val(JSON.stringify(d));var m=a(".content-p").length;var r=a(".content-img").length;var n=a(".content-video").length;var o=a(".mc-sub-content-container").length;var w=a(".content-gallery").length;var q=a(".content-audio").length;var v=a(".content-spacer").length;var t=a(".content-thumbnails").length;var s='<span class="comment">// Content stats</span><br /><br /><span class="num">'+m+'</span> paragraph(s), <span class="num">'+r+'</span> image(s)<br /><span class="num">'+n+'</span> video(s), <span class="num">'+o+'</span> column content(s)<br /><span class="num">'+w+'</span> gallery(s), <span class="num">'+q+'</span> audio file(s)<br /><span class="num">'+v+'</span> spacer(s), <span class="num">'+t+"</span> thumbview";a(".branding").val(JSON.stringify(d.branding));a(".stats").val(s);a(".content-code").html(s);a("#wpwrap").show();a("#semplice").fadeOut(300)}};a(document).on("click",".add-semplice-editor",function(){a("#semplice").appendTo("body");a(a.browser.webkit?"body":"html").animate({scrollTop:0},0,function(){a("#semplice").fadeIn(300,function(){a("#wpwrap").hide();g.init()})})});a("#semplice").on("click",".add-content",function(){if(!a("#semplice").hasClass("show-all-layers")){g.add(a(this))}else{alert("Please exit the layer mode to add new content")}});a("#semplice").on("click",".add-column-content",function(){g.addColumnContent(a(this))});a("#semplice").on("click",".add-column",function(){g.addColumn(a(this))});function k(){a("#semplice").off("click",".save");g.save(a(this))}a("#semplice").on("click",".save",k);function e(){a("#semplice").off("click",".save-mc");g.saveColumnContent(a(this))}a("#semplice").on("click",".save-mc",e);function c(){a("#semplice").off("click",".save-se");g.saveSingleEdit(a(this))}a("#semplice").on("click",".save-se",c);a("#semplice").on("click",".edit",function(){g.edit(a(this))});function i(){if(!a("#semplice").hasClass("show-all-layers")){a("#semplice").off("click",".content-container");g.edit(a(this))}else{g.hideLayers(a(this),true)}}a("#semplice").on("click",".content-container",i);a("#semplice").on("click",".edit-layer",i);a("#semplice").on("click",".video",function(m){m.stopPropagation()});a("#semplice").on("click",".mc-sub-content-container",function(m){var p=a(this);var o=a(this).offset().left,n=a(this).offset().top;a(this).children(".single-edit").css({top:(m.pageY-n),left:(m.pageX-o)}).show();a(this).find(".edit-column").unbind().click(function(){a(p).children(".single-edit").remove();g.edit(a(p))});a(this).find(".edit-single").unbind().click(function(){a(p).children(".single-edit").remove();g.singleEdit(a(p),a(this))})});a("#semplice").on("click",".remove",function(){a(".remove-confirm").data({"content-id":a(this).data("content-id"),"is-column":"","parent-id":""});a(".overlay").fadeIn(100);a(".confirm").fadeIn(100)});a("#semplice").on("click",".remove-column",function(){a(".remove-confirm").data({"content-id":a(this).data("column-id"),"is-column":"is-column","parent-id":a(this).data("parent-id")});a(".overlay").fadeIn(100);a(".confirm").fadeIn(100)});a("#semplice").on("click",".remove-confirm",function(){a(".overlay").fadeOut(100);a(".confirm").fadeOut(100);var m=a(this);if(a(this).data("is-column")==="is-column"){g.removeColumn(a(m))}else{g.remove(a(m))}});a("#semplice").on("click",".remove-decline",function(){a(".overlay").fadeOut(100);a(".confirm").fadeOut(100)});a("#semplice").on("click",".cancel-to-wp",function(){a(".overlay").fadeIn(100);a(".cancel").fadeIn(100)});a("#semplice").on("click",".cancel-confirm",function(){a(".overlay").fadeOut(100);a(".cancel").fadeOut(100,function(){a("#wpwrap").show();a("#semplice").fadeOut(300)})});a("#semplice").on("click",".cancel-decline",function(){a(".overlay").fadeOut(100);a(".cancel").fadeOut(100)});a("#semplice").on("click",".show-layers",function(){if(!a("#semplice").hasClass("show-all-layers")){g.showLayers(a(this))}else{g.hideLayers(a(this))}});a("#semplice").on("click",".hide-layers",function(){g.hideLayers(a(this))});a("#semplice").on("click",".up",function(){g.up(a(this))});a("#semplice").on("click",".down",function(){g.down(a(this))});a("#semplice").on("click",".column-up",function(){g.up(a(this))});a("#semplice").on("click",".column-down",function(){g.down(a(this))});a("#semplice").on("click",".remove-media",function(){g.removeMedia(a(this),a(this).data("media"))});a("#semplice").on("click",".save-to-wp",function(){if(a("#semplice-content").find(".in-edit-mode").length){alert("Please save or delete open edit fields.")}else{if(a("#semplice").hasClass("show-all-layers")){alert("Please exit the layer mode before save.")}else{g.saveToWp()}}});a("#semplice").on("change",".select-box",function(){var m=a(this).val();a(this).find("option").each(function(){if(a(this).val()===m){a(this).attr("selected","selected")}else{a(this).removeAttr("selected")}})});a("#semplice").on("change",".branding-bg-select",function(){var m=a(this).data("css-attribute");a("#semplice-content").css(m,a(this).val())});a("#semplice").on("change",".custom-fontset",function(){a(".loader").show();var m=a(this).val();a(this).find("option").each(function(){if(a(this).val()===m){a(this).attr("selected","selected")}else{a(this).removeAttr("selected")}});if(m!=="default"){g.customFontset(m)}else{if(default_fontset){g.customFontset(default_fontset)}else{g.customFontset()}}});a("#semplice").on("click","a.background",function(){a(this).next(".background-sub").fadeIn(150)});a("#semplice").on("click","a.ce-dismiss",function(){a(".overlay").fadeOut(150);a(".no-images").fadeOut(250)});a("#semplice").on("click","a.load-preset",function(){a(".preset-confirm").data({"preset-id":a(this).data("preset-id")});a(".overlay").fadeIn(100);a(".confirm-preset").fadeIn(100)});a("#semplice").on("click",".preset-confirm",function(){a(".overlay").fadeOut(100);a(".confirm-preset").fadeOut(100);g.loadPreset(a(this).data("preset-id"))});a("#semplice").on("click",".preset-decline",function(){a(".overlay").fadeOut(100);a(".confirm-preset").fadeOut(100)});a("#semplice").on("click","a.branding",function(){a(".branding-sub").fadeIn(150)});a("#semplice").on("click","a.show-options",function(){a(".options-sub").fadeIn(150)});a("#semplice").on("click","a.show-presets",function(){a(".presets-panel").fadeIn(250)});a("#semplice").on("click","a.padding",function(){a(this).next(".padding-sub").fadeIn(150)});a("#semplice").on("change","select[name=wysiwyg_bg_color]",function(){var m="#cke_"+a(this).data("content-id")+" .cke_wysiwyg_div";if(a(this).val()==="white"){a(m).css("backgroundColor","#ffffff")}else{a(m).css("backgroundColor","#000000")}});a("#semplice").mouseup(function(t){var s=a(".background-sub");var r=a(".media-modal-content");if(!s.is(t.target)&&!r.is(t.target)&&s.has(t.target).length===0){s.fadeOut(150)}var n=a(".branding-sub");if(!n.is(t.target)&&n.has(t.target).length===0){n.fadeOut(150)}var m=a(".options-sub");if(!m.is(t.target)&&m.has(t.target).length===0){m.fadeOut(150)}var o=a(".presets-panel");if(!o.is(t.target)&&o.has(t.target).length===0){o.fadeOut(250)}var p=a(".padding-sub");if(!p.is(t.target)&&p.has(t.target).length===0){p.fadeOut(150)}var q=a(".single-edit");if(!q.is(t.target)&&q.has(t.target).length===0){q.hide()}});a(".show-grid").toggle(function(){a("#grid").fadeIn("300");a(this).addClass("checked")},function(){a("#grid").fadeOut("300");a(this).removeClass("checked")});a("#semplice").on({mouseenter:function(){var m=a(this).find(".tooltip").width();m=(m-70)/2;a(this).find(".tooltip").css("marginLeft",-m);a(this).find(".tooltip").stop().fadeIn(120)},mouseleave:function(){a(this).find(".tooltip").stop().fadeOut(120)}},"ul.types li");function f(m){if(!m){return"transparent"}var o=m.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);function n(p){return("0"+parseInt(p).toString(16)).slice(-2)}if(o){return"#"+n(o[1])+n(o[2])+n(o[3])}else{return m}}var l={defaultColor:false,change:function(m,n){},hide:true,palettes:true};var b={defaultColor:false,change:function(m,n){a("#semplice-content").css("background-color",n.color.toString())},hide:true,palettes:true};var h=function(m){return m+"_"+Math.random().toString(36).substr(2,9)};function j(){a(window).scroll(function(){a.each(a(".sticky-mc-atts"),function(){var q=10;var p=a(this).height();var n=a(this).parent().offset().top;var m=a(this).parent().height();var o=a(window).scrollTop();if((n-q)<o&&o<(n-q+m-p)){if(!a(this).hasClass("is-sticky")){a(this).addClass("is-sticky");a(this).css("top",q+50);a(this).show()}}else{if(a(this).hasClass("is-sticky")){a(this).removeClass("is-sticky");a(this).css("top",n);a(this).hide()}}})})}})})(jQuery);