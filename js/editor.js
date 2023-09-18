function changeTemplateClass(cl) {
    
    if ( cl.length == 0 ) {
      cl = "default";
    }
    
    // definition der verschiedenen templates des themes
    const fullTemplates = ["page-blank-without-container.php"];
    const nSidebarTemplates = ["page-full-width-image.php", "page-sidebar-none.php", "page-sidebar-none-witout-thumbnail.php", "page-blank-with-container.php"];
    const nHeaderTemplates = ["page-blank-without-container.php", "page-blank-with-container.php"];
    const fullImgTemplates = ["page-full-width-image.php"];
    const widthImgTemplates = ["default", "page-sidebar-none.php", "page-sidebar-left.php"];

        
    // loop damit alles im DOM ist
    var checkExist = setInterval(function() {
    
      // auswahl der zu ändernden elemente
      const nodeListHeader = document.querySelectorAll(".edit-post-visual-editor__post-title-wrapper");
      const nodeListContainer = document.querySelectorAll(".block-editor-block-list__layout.is-root-container > *");
      
      // gibts ein beitragsbild?
      const nodeFeaturedImage = document.querySelectorAll(".editor-post-featured-image__container img");
      const nodeNoFeaturedImage = document.querySelectorAll(".editor-post-featured-image__container .editor-post-featured-image__toggle");

      // weiter gehts erst, wenn die elemente im DOM sind
      if (nodeListContainer.length && ( nodeFeaturedImage.length || nodeNoFeaturedImage.length ) ) {

        console.log("add classes for " + cl );
      
        // wenn es ein beitragsbild gibt, dann hole die url ( mit entfernen der thumbnail-pixel-angabe )
        if ( nodeFeaturedImage.length ) {
          var imgurl = nodeFeaturedImage[0].getAttribute('src');
          imgurl = imgurl.replace('-285x150','');
        }
        
        // überschrift klasse der front-page hinzufügen (schriftgröße und so)
        nodeListHeader[0].classList.add("entry-header");

        // Beitragsbild-div entfernen, falls vorhanden
        if ( nodeListHeader[0].querySelector("div.post-thumbnail") ) { 
          nodeListHeader[0].querySelector("div.post-thumbnail").remove();
        }
        
        // volle breite beitragsbild entfernen
        nodeListHeader[0].classList.remove("featured-full-width-img", "height-75", "bg-dark", "text-light", "align-items-end", "d-flex", "pb-3", "mb-3");
        nodeListHeader[0].querySelector("h1").classList.remove("entry-title", "container");
        nodeListHeader[0].style.backgroundImage = "none";
        
        // volle breite beitragsbild anzeigen
        if ( fullImgTemplates.includes(cl) ) {
            nodeListHeader[0].classList.add("featured-full-width-img", "height-75", "bg-dark", "text-light", "align-items-end", "d-flex", "pb-3", "mb-3");
            nodeListHeader[0].querySelector("h1").classList.add("entry-title", "container");
            if ( typeof imgurl !== 'undefined' ) {
              nodeListHeader[0].style.backgroundImage = "url(" + imgurl + ")";
            }
        }
        
        // normales beitragsbild einfügen
        if ( widthImgTemplates.includes(cl) ) {
            nodeListHeader[0].insertAdjacentHTML("beforeend", "<div class='post-thumbnail wp-block'></div>");
            if ( typeof imgurl !== 'undefined' ) {
              nodeListHeader[0].querySelector("div.post-thumbnail").insertAdjacentHTML("beforeend","<img class='rounded mb-3 wp-post-image' src='" + imgurl + "'/>");
            }
        } 

        // hole alle elemente des editors
        const nodeList = document.querySelectorAll(".edit-post-visual-editor__post-title-wrapper > *, .block-editor-block-list__layout.is-root-container > *");
        
        let i = 0;
        while (i < nodeList.length) {
          // Setze je nach template die verschiedenen css-klassen um die breite der front-page darzustellen
          nodeList[i].style.maxWidth = 'initial';
          nodeList[i].style.marginRight = 'initial';
          nodeList[i].style.marginLeft = 'initial';
          if ( fullTemplates.includes(cl) ) {
            nodeList[i].style.maxWidth = '100%';
          } else if ( nSidebarTemplates.includes(cl) ) {
            if(nodeList[i].getAttribute("data-align")==="right") {
              nodeList[i].style.cssText += 'margin-right:calc( ( 100% - 1320px ) / 2 ) !important';
            }
            if(nodeList[i].getAttribute("data-align")==="left") {
              nodeList[i].style.cssText += 'margin-left:calc( ( 100% - 1320px ) / 2 ) !important';
            }
            nodeList[i].style.maxWidth = '1320px';
          } else {
            if(nodeList[i].getAttribute("data-align")==="right") {
              nodeList[i].style.cssText += 'margin-right:calc( ( 100% - 990px ) / 2 ) !important';
            }
            if(nodeList[i].getAttribute("data-align")==="left") {
              nodeList[i].style.cssText += 'margin-left:calc( ( 100% - 990px ) / 2 ) !important';
            }
            nodeList[i].style.maxWidth = '990px';
          }
          
          // Überschrift entfernen, wenn template ohne ist.
          if ( nHeaderTemplates.includes(cl) ) {
            nodeListHeader[0].classList.add("d-none");
          } else {
            nodeListHeader[0].classList.remove("d-none");
          }
          i++;
        }
        
        
        clearInterval(checkExist);
      }

    }, 100); // check every 100ms
}



const { select, subscribe } = wp.data;

class PageTemplateSwitcher {

    constructor() {
        this.template = null;
    }

    init() {

        const oldTemplate = select( 'core/editor' ).getCurrentPostAttribute( 'template' );
        
        if (oldTemplate !== undefined) {
            this.template = oldTemplate;
            this.changeTemplate();
        }

        subscribe( () => {

            const newTemplate = select( 'core/editor' ).getEditedPostAttribute( 'template' );
                        
            if (newTemplate !== undefined && this.template === null) {
                this.template = newTemplate;
                this.changeTemplate();
            }

            if ( newTemplate !== undefined && newTemplate !== this.template ) {
                this.template = newTemplate;
                this.changeTemplate();
            }

        });
    }

    changeTemplate() {
        changeTemplateClass( this.template );
    }
}

new PageTemplateSwitcher().init();

