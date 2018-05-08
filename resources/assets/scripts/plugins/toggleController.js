const HOVERABLEController = () => {
  const ClassName = {
    VISIBLE: 'animate-fade-entered',
    HIDDEN: 'animate-fade-hidden',
  };

  const Selector = {
    HOVERABLE: '[data-toggle-link]',
    CLICKABLE: '[data-toggle-clickable]',
    ITEM: '[data-toggle-item]',
  };

  const $element = {
    HOVERABLE: $(Selector.HOVERABLE),
    CLICKABLE: $(Selector.CLICKABLE),
    ITEM: $(Selector.ITEM),
  };

  const timeoutTime = 300;

  function init() {
    let isVisible = false;
    let isToggled = false;

    $element.HOVERABLE.find(Selector.ITEM).each(function () {
      $(this).css({
        'transform': 'translateX(-50%)',
        'max-width': '300px',
      });
    });

    $element.HOVERABLE.hover(function () {
      const $theItem = $(this).find(Selector.ITEM);
      isVisible = true;
      $theItem.addClass(ClassName.VISIBLE);
      $theItem.removeClass(ClassName.HIDDEN);
    }, function () {
      const $theItem = $(this).find(Selector.ITEM);
      setTimeout(function () {
        if (!isVisible) {
          $theItem.removeClass(ClassName.VISIBLE);
          $theItem.addClass(ClassName.HIDDEN);
        }
      }, timeoutTime);
      isVisible = false;
    });

    $element.CLICKABLE.click(function () {
      const $theItem = $(this).find(Selector.ITEM);
      if(isToggled) {
        $theItem.addClass(ClassName.HIDDEN);
        $theItem.removeClass(ClassName.VISIBLE);
        isToggled = false;
      } else {
        $theItem.addClass(ClassName.VISIBLE);
        $theItem.removeClass(ClassName.HIDDEN);
        isToggled = true;
      }
    });
  }

  init();
};

export default HOVERABLEController;