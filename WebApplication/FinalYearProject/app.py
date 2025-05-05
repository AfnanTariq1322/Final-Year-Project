def preprocess_image(img):
    # Convert RGBA to RGB if necessary
    if img.mode == 'RGBA':
        img = img.convert('RGB')
    img = img.resize((224, 224))
    img_array = img_to_array(img)
    img_array = img_array / 255.0  # Normalize to [0,1]
    img_array = np.expand_dims(img_array, axis=0)
    return img_array 