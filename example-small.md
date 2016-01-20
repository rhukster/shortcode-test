# Shortcode Small Content

When creating content in **Grav**, you often need to display different types of media like **images**, **videos**, and various other **files**. These files are automatically found and processed by Grav and are made available to use by any page.  This is particularly handy because you can then use the built-in functionality of the page to leverage thumbnails, access metadata and modify the media dynamically (e.g. resizing images, setting the display size for videos, etc.) as you need them.

Grav uses a **smart-caching** system that automatically creates in-cache copies of the dynamically generated media when necessary. This way all subsequent requests can use the cached version instead of having to generate the media all over again.

## Where to put your media files

Usually you’ll use a media file within a page, so just put the file in the page folder, and you can reference it in the Markdown of the page, for example:

`![](image.jpg)`

If you want to put all your images in a single folder, you can put them in a `user/pages/images` folder. That way you can reach them via

`page->find('/images')->media['my-image.jpg']`

and also you can find them easily via markdown and perform operations on them:

`![](/images/my-image.jpg?cropResize=300,300)`

Alternatively you can put them in your theme, as that is easily accessible via CSS references.

## Thumbnail Location

There are three locations Grav will look for your thumbnail.

1. In the same folder as your media file: `[media-name].[media-extension].thumb.[thumb-extension]` where `media-name` and `media-extension` are respectively the name and extension of the original media file and `thumb-extension` is any extension that is supported by the `image` media type. Examples are `my_video.mp4.thumb.jpg` and `my-image.jpg.thumb.png`
**For images only!** The image itself will be used as thumbnail.
2. Your user folder: `user/images/media/thumb-[media-extension].png` where `media-extension` is the extension of the original media file. Examples are `thumb-mp4.png` and `thumb-jpg.jpg`
3. The system folder: `system/images/media/thumb-[media-extension].png` where `media-extension` is the extension of the original media file. **The thumbnails in the system folders are pre-provided by Grav.**
          |

## Actions

Grav employs a **builder-pattern** when handling media, so you can perform **multiple actions** on a particular medium. Some actions are available for every kind of medium while others are specific to the medium.

### General

These actions are available for all media types.

##### url()

!! This method is only intended to be used in **Twig** templates, hence the lack of Markdown syntax.

This returns **raw url path** to the media.


##### html([title][, alt][, classes])

---

# Shortcode Testing!!!!

this is regular code and [u]this is underlined text[/u] and this is [blue]blue text[/blue]
