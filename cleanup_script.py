import os
import re

def remove_comments(file_content, file_ext):
    if file_ext == '.php':
        # Hapus komentar Blade {{-- ... --}}
        file_content = re.sub(r'\{\{--.*?--\}\}', '', file_content, flags=re.DOTALL)
        
        # Hapus komentar multi-baris PHP /* ... */
        file_content = re.sub(r'/\*.*?\*/', '', file_content, flags=re.DOTALL)
        
        # Hapus komentar satu baris PHP // atau #
        # Perlu hati-hati agar tidak menghapus URL (misalnya http://)
        # Cocokkan // hanya jika tidak diawali dengan : (pengecekan sederhana untuk URL)
        file_content = re.sub(r'(?<!:)\/\/.*$', '', file_content, flags=re.MULTILINE)
        file_content = re.sub(r'^#.*$', '', file_content, flags=re.MULTILINE)
        
    elif file_ext == '.js':
        # Hapus console.log(...)
        file_content = re.sub(r'console\.log\(.*?\);?', '', file_content, flags=re.DOTALL)
        
        # Hapus komentar multi-baris JS /* ... */
        file_content = re.sub(r'/\*.*?\*/', '', file_content, flags=re.DOTALL)
        
        # Hapus komentar satu baris JS //
        # Sama seperti di atas, hindari menghapus URL
        file_content = re.sub(r'(?<!:)\/\/.*$', '', file_content, flags=re.MULTILINE)
        
    elif file_ext == '.css':
        # Hapus komentar multi-baris CSS /* ... */
        file_content = re.sub(r'/\*.*?\*/', '', file_content, flags=re.DOTALL)
        
    # Hapus komentar HTML untuk file blade/html/js
    if file_ext in ['.php', '.html', '.js']:
        file_content = re.sub(r'<!--.*?-->', '', file_content, flags=re.DOTALL)
        
    return file_content

def process_directory(directory):
    for root, dirs, files in os.walk(directory):
        if 'vendor' in dirs:
            dirs.remove('vendor')
        if 'node_modules' in dirs:
            dirs.remove('node_modules')
        if '.git' in dirs:
            dirs.remove('.git')
        if 'storage/framework' in root:
            continue
            
        for file in files:
            ext = os.path.splitext(file)[1]
            if ext in ['.php', '.js', '.css']:
                # Lewati file konfigurasi yang mungkin menggunakan pola khusus seperti glob
                if file in ['tailwind.config.js', 'vite.config.js', 'webpack.mix.js', 'postcss.config.js']:
                    print(f"Melewati file konfigurasi: {file}")
                    continue
                
                path = os.path.join(root, file)
                try:
                    with open(path, 'r', encoding='utf-8') as f:
                        content = f.read()
                    
                    new_content = remove_comments(content, ext)
                    
                    if new_content != content:
                        with open(path, 'w', encoding='utf-8') as f:
                            f.write(new_content)
                        print(f"Berhasil dibersihkan: {path}")
                except Exception as e:
                    print(f"Terjadi kesalahan saat memproses {path}: {e}")

if __name__ == "__main__":
    process_directory(".")
