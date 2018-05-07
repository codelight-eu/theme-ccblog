const toggleController = () => {
  const ClassName = {
    VISIBLE: 'animate-fade-entered',
    HIDDEN: 'animate-fade-hidden',
  };

  const Selector = {
    TOGGLE: '[data-toggle-link]',
    ITEM: '[data-toggle-item]',
  };

  const $element = {
    TOGGLE: $(Selector.TOGGLE),
    ITEM: $(Selector.ITEM),
  };

  const timeoutTime = 200;

  function init() {
    let isVisible = false;

    $element.TOGGLE.mouseover(function () {
      const $theItem = $(this).find(Selector.ITEM);
      isVisible = true;
      $theItem.addClass(ClassName.VISIBLE);
      $theItem.removeClass(ClassName.HIDDEN);
    }).mouseout(function () {
      const $theItem = $(this).find(Selector.ITEM);
      setTimeout(function(){
        if(!isVisible) {
          $theItem.removeClass(ClassName.VISIBLE);
          $theItem.addClass(ClassName.HIDDEN);
        }
      }, timeoutTime);
      isVisible = false;
    });
  }

  init();
};

export default toggleController;