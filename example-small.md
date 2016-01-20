# Shortcode Small Content

When creating content in **Grav**, you often need to display different types of media like **images**, **videos**, and various other **files**. These files are automatically found and processed by Grav and are made available to use by any page.  This is particularly handy because you can then use the built-in functionality of the page to leverage thumbnails, access metadata and modify the media dynamically (e.g. resizing images, setting the display size for videos, etc.) as you need them.

Grav uses a **smart-caching** system that automatically creates in-cache copies of the dynamically generated media when necessary. This way all subsequent requests can use the cached version instead of having to generate the media all over again.

## Supported Media Files

The following media file types are supported natively by Grav. Additional support for media files and streaming embeds may be added via plugins.

| Media Type         | File Type                    |
| :----------------- | :--------------------------  |
| Image              | jpg, jpeg, png               |
| Audio              | mp3, wav, wma, ogg, m4a      |
| Animated image     | gif                          |
| Vectorized image   | svg                          |
| Video              | mp4, mov, m4v, swf           |
| Data / Information | txt, doc, html, pdf, zip, gz |

A full list of supported mimetypes can be found in the `system/config/media.yaml` file.  If there is a mimetype that is not currently supported, you can simply create your own `user/config/media.yaml` and add it in there.  Just ensure you follow the same format as the original `system` file.  The simplest approach is to copy the whole original file and make your edits.

## Where to put your media files

Usually you’ll use a media file within a page, so just put the file in the page folder, and you can reference it in the Markdown of the page, for example:

`![](image.jpg)`

If you want to put all your images in a single folder, you can put them in a `user/pages/images` folder. That way you can reach them via

`page->find('/images')->media['my-image.jpg']`

and also you can find them easily via markdown and perform operations on them:

`![](/images/my-image.jpg?cropResize=300,300)`

Alternatively you can put them in your theme, as that is easily accessible via CSS references.

!!!! Grav has a `/images` folder. Do not put your own images in that folder, as it hosts Grav auto-generated, cached images.

## Display modes

Grav provides a few different display modes for every kind of media object.

|    Mode   |                                   Explanation                                   |
| :-------- | :------------------------------------------------------------------------------ |
| source    | Visual representation of the media itself, i.e. the actual image, video or file |
| text      | Textual representation of the media                                             |
| thumbnail | The thumbnail image for this media object                                       |

!!!! **Data / Information** type media do not support `source` mode, they will default to `text` mode if another mode is not explicitly chosen.

## Thumbnail Location

There are three locations Grav will look for your thumbnail.

1. In the same folder as your media file: `[media-name].[media-extension].thumb.[thumb-extension]` where `media-name` and `media-extension` are respectively the name and extension of the original media file and `thumb-extension` is any extension that is supported by the `image` media type. Examples are `my_video.mp4.thumb.jpg` and `my-image.jpg.thumb.png`
**For images only!** The image itself will be used as thumbnail.
2. Your user folder: `user/images/media/thumb-[media-extension].png` where `media-extension` is the extension of the original media file. Examples are `thumb-mp4.png` and `thumb-jpg.jpg`
3. The system folder: `system/images/media/thumb-[media-extension].png` where `media-extension` is the extension of the original media file. **The thumbnails in the system folders are pre-provided by Grav.**

!! You can also manually select the desired thumbnail with the actions explained below.

## Links and Lightboxes

The display modes above can also be used in combination with links and lightboxes, which are explained in more detail later. Important to note however is:

!!!! Grav does not provide lightbox-functionality out of the box, you need a plugin for this. You can use the [FeatherLight Grav plugin](https://github.com/getgrav/grav-plugin-featherlight) to achieve this.

When you use Grav's media functionality to render a lightbox, all Grav does is output an **anchor** tag that has some attributes for the lightbox plugin to read. If you are interested in using a lightbox library that is not in our plugin repository or you want to create your own plugin, you can use the table below as a reference.

|  Attribute  |                                                 Explanation                                                  |
| :---------- | :----------------------------------------------------------------------------------------------------------- |
| rel         | A simple indicator that this is not a regular link, but a lightbox link. The value will always be `lightbox` |
| href        | A URL to the media object itself                                                                             |
| data-width  | The width the user requested this lightbox to be                                                             |
| data-height | The height the user requested this lightbox to be                                                            |
| data-srcset | In case of image media, this contains the `srcset` string. ([more info](../media#responsive-images))                 |

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
