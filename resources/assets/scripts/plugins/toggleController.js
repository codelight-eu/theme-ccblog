const HOVERABLEController = () => {

  const BreakPoint = 1024;

  const ClassName = {
    VISIBLE: 'animate-fade-entered',
    HIDDEN: 'animate-fade-hidden',
  };

  const Selector = {
    HOVERABLE: '[data-toggle-link]',
    ITEM: '[data-toggle-item]',
    CENTRIZE: '[data-toggle-setCenter]',
  };

  const $element = {
    HOVERABLE: $(Selector.HOVERABLE),
    ITEM: $(Selector.ITEM),
  };

  const timeoutTime = 300;

  function init() {
    let isVisible = false;

    $element.HOVERABLE.find(Selector.CENTRIZE).each(function () {
      $(this).css({
        'transform': 'translateX(-50%)',
        'max-width': '300px',
      });
    });

    if(window.matchMedia(`(min-width: ${BreakPoint}px)`).matches) {
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
    } else {
      $element.HOVERABLE.click(function () {
        const $theItem = $(this).find(Selector.ITEM);
        if ($theItem.hasClass(ClassName.VISIBLE)) {
          $theItem.addClass(ClassName.HIDDEN);
          $theItem.removeClass(ClassName.VISIBLE);
        } else {
          $theItem.addClass(ClassName.VISIBLE);
          $theItem.removeClass(ClassName.HIDDEN);
        }
      });
    }
  }

  init();
};

export default HOVERABLEController;