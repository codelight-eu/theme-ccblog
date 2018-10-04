const contextBarController = () => {

  const ItemCss = {
    'width': '100%',
  };

  const ClassName = {
    ADD: 'animate-fade-entered',
    REMOVE: 'animate-fade-hidden',
  };

  const Selector = {
    WINDOW: window,
    ITEM: '[data-contextBar]',
  };

  const $element = {
    WINDOW: $(Selector.WINDOW),
    ITEM: $(Selector.ITEM),
  };

  function init() {
    let isFixed = false;

    $element.WINDOW.on('scroll', function () {
      const itemHeight = $element.ITEM.outerHeight();
      const window = $(this);

      if (window.scrollTop() > itemHeight) {
        if(!isFixed) {
          $element.ITEM.css(ItemCss).addClass(ClassName.ADD).removeClass(ClassName.REMOVE);
          isFixed = true;
        }
      } else {
        if(isFixed) {
          $element.ITEM.css(clearCss()).removeClass(ClassName.ADD).addClass(ClassName.REMOVE);
          isFixed = false;
        }
      }
    });
  }

  init();

  function clearCss() {
    let clearedValues = {};
    for (let key in ItemCss) {
      clearedValues[key] = '';
    }
    return clearedValues;
  }
};

export default contextBarController;