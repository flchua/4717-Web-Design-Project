from PIL import Image
from glob import glob

if __name__ == "__main__":
    assets = glob('./assets/*.png')
    for img_f in assets:
        img = Image.open(img_f)
    	h,w = img.size
    	img = img.resize((h//2, w//2), Image.ANTIALIAS)
    	img.save(img_f, optimize=True, quality=80)
