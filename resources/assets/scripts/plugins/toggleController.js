const toggleController = () => {

  const BreakPoint = 1024;

  const ClassName = {
    ANIM_VISIBLE: 'animate-fade-entered',
    ANIM_HIDDEN: 'animate-fade-hidden',
    INVISIBLE: 'invisible',
    OPENSTATE: 'js-toggle-opened',
    ZINDEX: 'z-high',
  };

  const Selector = {
    CONTAINER: '[data-toggle-container]',
    HOVERABLE: '[data-toggle-link]',
    CLICKABLE: '[data-toggle-clickable]',
    ITEM: '[data-toggle-item]',
    CENTRIZE: '[data-toggle-setCenter]',
    CONTENT: '[data-toggle-content]',
    ICON_OPEN: '[data-toggle-icon-open]',
    ICON_CLOSE: '[data-toggle-icon-close]',
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
          $(this).removeClass(ClassName.ANIM_VISIBLE);
          $(this).addClass(ClassName.ANIM_HIDDEN);
        });
        $element.CONTAINER.each(function(){
          $(this).removeClass(ClassName.OPENSTATE);
        });
        $theItem.addClass(ClassName.ANIM_VISIBLE);
        $theItem.removeClass(ClassName.ANIM_HIDDEN);
      }, function () {
        const $theItem = $(this).parents(Selector.CONTAINER).find(Selector.ITEM);
        setTimeout(function () {
          if (!isVisible) {
            $theItem.removeClass(ClassName.ANIM_VISIBLE);
            $theItem.addClass(ClassName.ANIM_HIDDEN);
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
            $contentItem.removeClass(ClassName.ANIM_VISIBLE);
            $contentItem.addClass(ClassName.ANIM_HIDDEN);
          }
        }, timeoutTime);
      });

    } else {
      /* Make hoverable toggle-content visible on clicks on smaller screens */
      $element.HOVERABLE.click(function () {
        const $theContainer = $(this).parents(Selector.CONTAINER);
        const $theItem = $(this).parents(Selector.CONTAINER).find(Selector.ITEM);
        const $openIcon = $(this).find(Selector.ICON_OPEN);
        const $closeIcon = $(this).find(Selector.ICON_CLOSE);
        if ($theItem.hasClass(ClassName.ANIM_VISIBLE)) {
          $theItem.addClass(ClassName.ANIM_HIDDEN);
          $theItem.removeClass(ClassName.ANIM_VISIBLE);
          $theContainer.removeClass(ClassName.ZINDEX);
          if($openIcon.length > 0 && $closeIcon.length > 0){
            $openIcon.removeClass(ClassName.INVISIBLE);
            $closeIcon.addClass(ClassName.INVISIBLE);
          }
        } else {
          $element.ITEM.each(function(){
            $(this).removeClass(ClassName.ANIM_VISIBLE);
            $(this).addClass(ClassName.ANIM_HIDDEN);
          });
          $element.CONTAINER.each(function(){
            $(this).removeClass(ClassName.OPENSTATE);
          });
          $theItem.addClass(ClassName.ANIM_VISIBLE);
          $theItem.removeClass(ClassName.ANIM_HIDDEN);
          $theContainer.addClass(ClassName.ZINDEX);
          if($openIcon.length > 0 && $closeIcon.length > 0){
            $closeIcon.removeClass(ClassName.INVISIBLE);
            $openIcon.addClass(ClassName.INVISIBLE);
          }
        }
      });
    }

    /* toggle function for clicking */
    $element.CLICKABLE.click(function () {
      const $theContainer = $(this).parents(Selector.CONTAINER);
      const $theItem = $(this).parents(Selector.CONTAINER).find(Selector.ITEM);
      if ($theItem.hasClass(ClassName.ANIM_VISIBLE)) {
        $theItem.addClass(ClassName.ANIM_HIDDEN);
        $theItem.removeClass(ClassName.ANIM_VISIBLE);
        $theContainer.removeClass(ClassName.OPENSTATE);
      } else {
        $element.ITEM.each(function(){
          $(this).removeClass(ClassName.ANIM_VISIBLE);
          $(this).addClass(ClassName.ANIM_HIDDEN);
        });
        $theItem.addClass(ClassName.ANIM_VISIBLE);
        $theItem.removeClass(ClassName.ANIM_HIDDEN);
        $theContainer.addClass(ClassName.OPENSTATE);
      }
    });
  }

  init();
};

export default toggleController;