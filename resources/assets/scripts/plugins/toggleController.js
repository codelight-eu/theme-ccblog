const toggleController = () => {

  const BreakPoint = 1024;

  const ClassName = {
    VISIBLE: 'animate-fade-entered',
    HIDDEN: 'animate-fade-hidden',
    OPENSTATE: 'js-toggle-opened',
    ZINDEX: 'z-high',
    ICON_MENU: 'icon-menu-charcoal',
    ICON_X: 'icon-x-charcoal',
  };

  const Selector = {
    CONTAINER: '[data-toggle-container]',
    HOVERABLE: '[data-toggle-link]',
    CLICKABLE: '[data-toggle-clickable]',
    ITEM: '[data-toggle-item]',
    CENTRIZE: '[data-toggle-setCenter]',
    CONTENT: '[data-toggle-content]',
    ICON: '[class*="icon-"]',
    ICON_MENU: '.' + ClassName.ICON_MENU,
    ICON_X: '.' + ClassName.ICON_X,
  };

  const $element = {
    HOVERABLE: $(Selector.HOVERABLE),
    CLICKABLE: $(Selector.CLICKABLE),
    CONTAINER: $(Selector.CONTAINER),
    ITEM: $(Selector.ITEM),
  };

  const timeoutTime = 300;

  function init() {
    let isVisible = false;

    /* Adjust targeted content */
    $element.HOVERABLE.parents(Selector.CONTAINER).find(Selector.CENTRIZE).each(function () {
      $(this).css({
        'transform': 'translateX(-50%)',
        'max-width': '300px',
      });
    });

    if(window.matchMedia(`(min-width: ${BreakPoint}px)`).matches) {

      /* Show and hide content on hover */
      $element.HOVERABLE.hover(function () {
        const $theItem = $(this).parents(Selector.CONTAINER).find(Selector.ITEM);
        isVisible = true;
        $element.ITEM.each(function(){
          $(this).removeClass(ClassName.VISIBLE);
          $(this).addClass(ClassName.HIDDEN);
        });
        $element.CONTAINER.each(function(){
          $(this).removeClass(ClassName.OPENSTATE);
        });
        $theItem.addClass(ClassName.VISIBLE);
        $theItem.removeClass(ClassName.HIDDEN);
      }, function () {
        const $theItem = $(this).parents(Selector.CONTAINER).find(Selector.ITEM);
        setTimeout(function () {
          if (!isVisible) {
            $theItem.removeClass(ClassName.VISIBLE);
            $theItem.addClass(ClassName.HIDDEN);
          }
        }, timeoutTime);
        isVisible = false;
      });

      /* When hovering content, disable hiding */
      let $contentItem;
      $element.ITEM.hover(function(){
        $contentItem = $(this);
        isVisible = true;
      }, function(){
        isVisible = false;
        setTimeout(function () {
          if (!isVisible) {
            $contentItem.removeClass(ClassName.VISIBLE);
            $contentItem.addClass(ClassName.HIDDEN);
          }
        }, timeoutTime);
      });

    } else {
      /* Make hoverable toggle-content visible on clicks on smaller screens */
      $element.HOVERABLE.click(function () {
        const $theContainer = $(this).parents(Selector.CONTAINER);
        const $theItem = $(this).parents(Selector.CONTAINER).find(Selector.ITEM);
        const $theIcon = $(this).find(Selector.ICON).eq(0);
        if ($theItem.hasClass(ClassName.VISIBLE)) {
          $theItem.addClass(ClassName.HIDDEN);
          $theItem.removeClass(ClassName.VISIBLE);
          $theContainer.removeClass(ClassName.ZINDEX);
          if($theIcon.length > 0 && $theIcon.hasClass(ClassName.ICON_X)){
            $theIcon.removeClass(ClassName.ICON_X);
            $theIcon.addClass(ClassName.ICON_MENU);
          }
        } else {
          $element.ITEM.each(function(){
            $(this).removeClass(ClassName.VISIBLE);
            $(this).addClass(ClassName.HIDDEN);
          });
          $element.CONTAINER.each(function(){
            $(this).removeClass(ClassName.OPENSTATE);
          });
          $theItem.addClass(ClassName.VISIBLE);
          $theItem.removeClass(ClassName.HIDDEN);
          $theContainer.addClass(ClassName.ZINDEX);
          if($theIcon.length > 0 && $theIcon.hasClass(ClassName.ICON_MENU)){
            $theIcon.addClass(ClassName.ICON_X);
            $theIcon.removeClass(ClassName.ICON_MENU);
          }
        }
      });
    }

    /* toggle function for clicking */
    $element.CLICKABLE.click(function () {
      const $theContainer = $(this).parents(Selector.CONTAINER);
      const $theItem = $(this).parents(Selector.CONTAINER).find(Selector.ITEM);
      if ($theItem.hasClass(ClassName.VISIBLE)) {
        $theItem.addClass(ClassName.HIDDEN);
        $theItem.removeClass(ClassName.VISIBLE);
        $theContainer.removeClass(ClassName.OPENSTATE);
      } else {
        $element.ITEM.each(function(){
          $(this).removeClass(ClassName.VISIBLE);
          $(this).addClass(ClassName.HIDDEN);
        });
        $theItem.addClass(ClassName.VISIBLE);
        $theItem.removeClass(ClassName.HIDDEN);
        $theContainer.addClass(ClassName.OPENSTATE);
      }
    });
  }

  init();
};

export default toggleController;