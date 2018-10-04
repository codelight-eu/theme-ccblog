const toggleController = () => {

  const BreakPoint = 1024;

  const ClassName = {
    ANIM_VISIBLE: 'animate-fade-entered',
    ANIM_HIDDEN: 'animate-fade-hidden',
    INVISIBLE: 'invisible',
    SHOW: 'js-toggle-show',
    OPENSTATE: 'js-toggle-opened',
    ZINDEX: 'z-high',
    SUBMENU_ITEM_REMOVE: 'inline-block medium-up-inline-block padding-small',
    SUBMENU_ITEM: 'block text-left padding-horz-large padding-vert-xsmall',
    SUBMENU_ICON: 'menu_more-icon',
    SUBMENU_ICON_STATE1: 'icon-chevron-right',
    SUBMENU_ICON_STATE2: 'icon-chevron-down',
  };

  const Selector = {
    CONTAINER: '[data-toggle-container]',
    HOVERABLE: '[data-toggle-link]',
    CLICKABLE: '[data-toggle-clickable]',
    ITEM: '[data-toggle-item], .sub-menu',
    CENTRIZE: '[data-toggle-setCenter]',
    CONTENT: '[data-toggle-content]',
    ICON_OPEN: '[data-toggle-icon-open]',
    ICON_CLOSE: '[data-toggle-icon-close]',
  };

  const MenuSelector = {
    CONTAINER: '.menu-item-has-children',
    ITEM: '.sub-menu',
    HOVERABLE: '.menu-item-has-children > a',
    NOT_HOVERABLE: '.js-toggle-noSubMenuHover .menu-item-has-children > a',
    NOT_HOVERABLE_ITEM: '.js-toggle-noSubMenuHover .sub-menu',
    SUBMENU_ICON: '.' + ClassName.SUBMENU_ICON,
  };

  const $element = {
    HOVERABLE: $(Selector.HOVERABLE + ', ' + MenuSelector.HOVERABLE).not(MenuSelector.NOT_HOVERABLE),
    CLICKABLE: $(Selector.CLICKABLE + ', ' + MenuSelector.NOT_HOVERABLE),
    CONTAINER: $(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER),
    ITEM: $(Selector.ITEM + ', ' + MenuSelector.ITEM),
  };

  const timeoutTime = 300;

  function init() {
    let isVisible = false;

    /* Adjust targeted content */
    $element.HOVERABLE.parents(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).find(Selector.CENTRIZE + ', ' + MenuSelector.ITEM).not(MenuSelector.NOT_HOVERABLE_ITEM).each(function () {
      const cssConf = {
        'transform': 'translateX(-50%)',
        'max-width': ($(this).is(MenuSelector.ITEM) ? '160px' : '300px'),
      };

      $(this).css(cssConf);
      $(this).find('.menu-item').each(function () {
        $(this).removeClass(ClassName.SUBMENU_ITEM_REMOVE);
        $(this).addClass(ClassName.SUBMENU_ITEM);
      });
    });

    if (window.matchMedia(`(min-width: ${BreakPoint}px)`).matches) {

      /* Prevent default action in case hoverable element is clicked */
      $element.HOVERABLE.click(function (e) {
        e.preventDefault();
      });

      /* Show and hide content on hover */
      $element.HOVERABLE.hover(function () {
        const $theItem = $(this).closest(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).find(Selector.ITEM).eq(0);
        isVisible = true;

        /* Hide all elements if a hoverable element is hovered */
        $element.ITEM.not(MenuSelector.NOT_HOVERABLE_ITEM).each(function () {
          $(this).removeClass(ClassName.ANIM_VISIBLE);
          $(this).addClass(ClassName.ANIM_HIDDEN);
        });
        $element.CONTAINER.each(function () {
          $(this).removeClass(ClassName.OPENSTATE);
        });

        /* Show the current hoverable element */
        $theItem.addClass(ClassName.ANIM_VISIBLE);
        $theItem.removeClass(ClassName.ANIM_HIDDEN);
      }, function () {
        const $theItem = $(this).parents(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).find(Selector.ITEM).not(MenuSelector.NOT_HOVERABLE_ITEM);
        /* Hide the hoverable element after timeout and when not hovering it */
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
      $element.ITEM.not(MenuSelector.NOT_HOVERABLE_ITEM).hover(function () {
        $contentItem = $(this);
        isVisible = true;
      }, function () {
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
      $element.HOVERABLE.click(function (e) {
        e.preventDefault();
        const $theContainer = $(this).closest(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER);
        const $theItem = $(this).closest(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).find(Selector.ITEM);
        const $openIcon = $(this).find(Selector.ICON_OPEN);
        const $closeIcon = $(this).find(Selector.ICON_CLOSE);
        if ($theItem.hasClass(ClassName.ANIM_VISIBLE)) {
          $theItem.addClass(ClassName.ANIM_HIDDEN);
          $theItem.removeClass(ClassName.ANIM_VISIBLE);
          $theContainer.removeClass(ClassName.ZINDEX);
          if ($openIcon.length > 0 && $closeIcon.length > 0) {
            $openIcon.removeClass(ClassName.INVISIBLE);
            $closeIcon.addClass(ClassName.INVISIBLE);
          }
        } else {
          $element.ITEM.each(function () {
            $(this).removeClass(ClassName.ANIM_VISIBLE);
            $(this).addClass(ClassName.ANIM_HIDDEN);
          });
          $element.CONTAINER.each(function () {
            $(this).removeClass(ClassName.OPENSTATE);
          });
          $theItem.addClass(ClassName.ANIM_VISIBLE);
          $theItem.removeClass(ClassName.ANIM_HIDDEN);
          $theContainer.addClass(ClassName.ZINDEX);

          if ($openIcon.length > 0 && $closeIcon.length > 0) {
            $closeIcon.removeClass(ClassName.INVISIBLE);
            $openIcon.addClass(ClassName.INVISIBLE);
          }
        }
      });
    }

    /* toggle function for clicking */
    $element.CLICKABLE.click(function (e) {
      e.preventDefault();
      const $theContainer = $(this).closest(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER);
      const $theItem = $(this).closest(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).find(Selector.ITEM);
      const $theSubmenuIcon = $theContainer.find(MenuSelector.SUBMENU_ICON);
      let showClass, hideClass;

      $(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).each(function(){

      });

      /* Check if the item is clickable submenu item*/
      if ($theItem.is(MenuSelector.NOT_HOVERABLE_ITEM)) {
        showClass = ClassName.SHOW;
        hideClass = '';
      } else {
        showClass = ClassName.ANIM_VISIBLE;
        hideClass = ClassName.ANIM_HIDDEN;
      }

      if ($theItem.hasClass(showClass)) {
        $theItem.addClass(hideClass);
        $theItem.removeClass(showClass);
        $theContainer.removeClass(ClassName.OPENSTATE);

        /* Change the icon when submenu is opened */
        if ($theItem.is(MenuSelector.NOT_HOVERABLE_ITEM)) {
          $theSubmenuIcon.addClass(ClassName.SUBMENU_ICON_STATE1);
          $theSubmenuIcon.removeClass(ClassName.SUBMENU_ICON_STATE2)
        }
      } else {
        $element.ITEM.each(function () {
          $(this).removeClass(showClass);
          $(this).addClass(hideClass);

          /* Change the icon when another submenu is opened */
          if ($theItem.is(MenuSelector.NOT_HOVERABLE_ITEM)) {
            $(this).closest(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).find(MenuSelector.SUBMENU_ICON).addClass(ClassName.SUBMENU_ICON_STATE1);
            $(this).closest(Selector.CONTAINER + ', ' + MenuSelector.CONTAINER).find(MenuSelector.SUBMENU_ICON).removeClass(ClassName.SUBMENU_ICON_STATE2)
          }
        });
        $theItem.addClass(showClass);
        $theItem.removeClass(hideClass);
        $theItem.parents(Selector.ITEM).eq(0).addClass(showClass);
        $theItem.parents(Selector.ITEM).eq(0).removeClass(hideClass);
        $theContainer.addClass(ClassName.OPENSTATE);

        /* Change the icon when submenu is closed */
        if ($theItem.is(MenuSelector.NOT_HOVERABLE_ITEM)) {
          $theSubmenuIcon.addClass(ClassName.SUBMENU_ICON_STATE2);
          $theSubmenuIcon.removeClass(ClassName.SUBMENU_ICON_STATE1)
        }
      }
    });
  }

  init();
};

export default toggleController;